<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Assignment;
use App\User;

class UserController extends Controller
{
    public function login(Request $request){
    	if($request->session()->has('id')){
            if($request->session()->get('type') == 'User')
              return redirect('dashboard');
            if($request->session()->get('type') == 'Administrator')
              return redirect('backend/dashboard');
		}
        return view('user/login');
    }
    public function login_post(Request $request){
        $rules = [
                    'username' => 'required',
                    'password' => 'required'
                ];
        $this->validate($request, $rules);
        $where = [
                    'username' => $request->username,
                    'password' => md5($request->password),
                    'active'   => 1
                ];
        $check = User::select('id', 'username', 'name', 'image', 'email', 'phone', 'type')->where($where);
        if($check->count() > 0){
	        $user = $check->first()->toArray();
            if($user['image'] == null)
                $user['image'] = 'no_image.jpg';
			$request->session()->put($user);
            if($user['type'] == 'Administrator')
               return redirect('backend/dashboard');
            else
               return redirect('dashboard');
		}
		else{
        	Session::flash('message', 'Login invalid');
        	return redirect('user/login');
		}
    }
    public function logout(Request $request){
    	$request->session()->flush();
        return redirect('user/login');
    }

    public function profile(Request $request, $id){
        if(!$request->session()->has('id')){
            return redirect('user/login');
        }
        $data['request'] = $request;
        $data['title'] = 'Profile';

        $data['user'] = User::find($id);
        $data['assignment'] = Assignment::where(['user_id' => $id])->groupBy('topic_id')->get();

        return view('user/profile', $data);
    }
    public function profile_post(Request $request){
        if(!$request->session()->has('id'))
            return redirect('user/login');
        if($request->session()->get('id') != $request->id)
            return redirect('user/login');
        $username = $request->username != '' ? $request->username : null;
        $email = $request->email != '' ? $request->email : null;
        $phone = $request->phone != '' ? $request->phone : null;
        $data = [
                    'username' => $username,
                    'name' => $request->name,
                    'email' => $email,
                    'phone' => $phone,
                ];
        if($request->password != null){
            $password = md5($request->password);
            $data['password'] = $password;
            $data['temp_password'] = null;
        }
        $folder = "images/user";
        $image = $request->file('image');
        if($image != null){
            $image_name = $request->id.".".$image->getClientOriginalExtension();
            $image->move($folder, $image_name);
            $data['image'] = $image_name;
        }
        $user = User::find($request->id);
        $user->update($data);
        $user = User::select('id', 'username', 'name', 'image', 'email', 'phone', 'type')->find($request->id)->toArray();
        $request->session()->put($user);
        return redirect('user/profile/'.$request->id);
    }
    public function f_index(Request $request){
        if($request->session()->get('type') != 'User'){
            return redirect('user/login');
        }
        $data['request'] = $request;
        $data['title'] = 'User';

        $data['user'] = User::orderBy('name')->where(['type' => 'User'])->get();
        return view('user/f_index', $data);
    }
    public function index(Request $request){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $data['request'] = $request;
        $data['title'] = 'User';

        $data['user'] = User::orderBy('name')->where(['type' => 'User'])->get();
        return view('user/index', $data);
    }
    public function add_post(Request $request){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $username = $request->username != '' ? $request->username : null;
        $email = $request->email != '' ? $request->email : null;
        $phone = $request->phone != '' ? $request->phone : null;
        $active = $request->active != null ? 1 : 0;
        $password = md5($request->password);
        $data = [
                    'username' => $username,
                    'name' => $request->name,
                    /*'password' => $password,*/
                    'email' => $email,
                    'phone' => $phone,
                    'type' => 'User',
                    'active' => $active
                ];
        $id = User::create($data)->id;
        $folder = "images/user";
        $image = $request->file('image');
        $image_name = $id.".".$image->getClientOriginalExtension();
        $image->move($folder, $image_name);

        unset($data);
        $data = [
                    'image' => $image_name
               ];
        User::find($id)->update($data);
        return redirect('backend/user');
    }
    public function edit_post(Request $request){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $username = $request->username != '' ? $request->username : null;
        $email = $request->email != '' ? $request->email : null;
        $phone = $request->phone != '' ? $request->phone : null;
        $active = $request->active != null ? 1 : 0;
        $data = [
                    'username' => $username,
                    'name' => $request->name,
                    'email' => $email,
                    'phone' => $phone,
                    'active' => $active
                ];
        /*if($request->password != null){
            $password = md5($request->password);
            $data['password'] = $password;
        }*/
        $folder = "images/user";
        $image = $request->file('image');
        if($image != null){
            $image_name = $request->id.".".$image->getClientOriginalExtension();
            $image->move($folder, $image_name);
            $data['image'] = $image_name;
        }
        $user = User::find($request->id)->update($data);
        return redirect('backend/user');
    }

    public function delete(Request $request, $id){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $user = User::find($id)->update(['active' => 0]);
        return redirect('backend/user');
    }

    public function reset_password(Request $request, $id){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $user = User::find($id);
        if($user->username == null || $user->phone == null){
            echo "<script>alert('Username or phone is empty');window.close();</script>";
        }
        else{
            $password = Str::lower(Str::random(3));
            $md5_password = md5($password);
            $data = [
                        'password' => $md5_password,
                        'temp_password' => $password,
                    ];
            $user->update($data);
            $text = urlencode('*KPMK lite* - Hi '.$user->name.', password anda telah diperbaharui. Silahkan login di '.url('/').' dengan data:
Username : '.$user->username.'
Password : '.$password.'
Terima kasih.');
            $url = 'https://api.whatsapp.com/send?phone='.$user->phone.'&text='.$text;
            //echo $url;
            return Redirect::to($url);
        }
    }
}
