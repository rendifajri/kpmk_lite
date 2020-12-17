<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Program;
use App\Topic;
use App\Assignment;

class ProgramController extends Controller
{
    public function f_index(Request $request){
        if($request->session()->get('type') != 'User'){
            return redirect('user/login');
        }
        $data['request'] = $request;
        $data['title'] = 'Program';

        $data['program'] = Program::orderBy('name')->get();
        return view('program/f_index', $data);
    }
    public function f_detail(Request $request, $id){
        if($request->session()->get('type') != 'User'){
            return redirect('user/login');
        }
        $data['request'] = $request;
        $data['title'] = 'Program';
        $data['sub_title'] = 'Detail';

        $data['program'] = Program::find($id);
        return view('program/f_detail', $data);
    }
    public function assignment(Request $request, $topic_id, $user_id){
        if(!$request->session()->has('id')){
            return redirect('user/login');
        }
        $data['request'] = $request;
        $data['title'] = 'Program';
        $data['sub_title'] = 'Detail';
        $data['sub_sub_title'] = 'Assignment';

        $data['user_id'] = $user_id;
        $data['topic'] = Topic::find($topic_id);
        return view('program/assignment', $data);
    }
    public function index(Request $request){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $data['request'] = $request;
        $data['title'] = 'Program';

        $data['program'] = Program::orderBy('name')->get();
        return view('program/index', $data);
    }
    public function add_post(Request $request){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $active = $request->active != null ? 1 : 0;
        $password = md5($request->password);
        $data = [
                    'name' => $request->name,
                    'description' => $request->description,
                    'active' => $active
                ];
        $id = Program::create($data)->id;
        $folder = "images/program";
        $image = $request->file('image');
        $image_name = $id.".".$image->getClientOriginalExtension();
        $image->move($folder, $image_name);
        unset($data);
        $data = [
                    'image' => $image_name
               ];
        $folder = "files/program";
        $files = $request->file('data_files');
        $files_name = [];
        $i = 0;
        if($request->hasFile('data_files')){
            foreach ($files as $file) {
                //$files_name[$i] = $request->id."_".$i.".".$file->getClientOriginalExtension();
                $files_name[$i] = $file->getClientOriginalName();
                $file->move($folder, $files_name[$i]);
                $i++;
            }
            $data['files'] = implode(',', $files_name);
            Program::find($id)->update($data);
        }
        return redirect('backend/program');
    }
    public function edit_post(Request $request){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $active = $request->active != null ? 1 : 0;
        $data = [
                    'name' => $request->name,
                    'description' => $request->description,
                    'active' => $active
                ];
        $folder = "images/program";
        $image = $request->file('image');
        if($image != null){
            $image_name = $request->id.".".$image->getClientOriginalExtension();
            $image->move($folder, $image_name);
            $data['image'] = $image_name;
        }
        $folder = "files/program";
        $files = $request->file('data_files');
        $files_name = [];
        $i = 0;
        if($request->hasFile('data_files')){
            foreach ($files as $file) {
                //$files_name[$i] = $request->id."_".$i.".".$file->getClientOriginalExtension();
                $files_name[$i] = $file->getClientOriginalName();
                $file->move($folder, $files_name[$i]);
                $i++;
            }
            $data['files'] = implode(',', $files_name);
        }
        $program = Program::find($request->id)->update($data);
        return redirect('backend/program');
    }

    public function delete(Request $request, $id){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $program = Program::find($id)->update(['active' => 0]);
        return redirect('backend/program');
    }

}
