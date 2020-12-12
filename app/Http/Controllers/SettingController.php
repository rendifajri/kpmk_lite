<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    public function index(Request $request){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $data['request'] = $request;
        $data['title'] = 'Setting';

        $data['setting'] = Setting::first();
        return view('setting/index', $data);
    }
    public function add_post(Request $request){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $data = [
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'youtube' => $request->youtube,
                    'whatsapp' => $request->whatsapp,
                    'email' => $request->email
                ];
        if(Setting::count() == 0)
        	Setting::create($data)->id;
        else
        	Setting::first()->update($data);
        return redirect('backend/setting');
    }
}
