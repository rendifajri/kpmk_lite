<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function f_index(Request $request)
    {
    	if($request->session()->get('type') != 'User')
    		return redirect('user/login');
    	$data['title'] = 'Dashboard';
        return view('dashboard/index', $data);
    }
    public function index(Request $request)
    {
    	if($request->session()->get('type') != 'Administrator')
    		return redirect('user/login');
    	$data['title'] = 'Dashboard';
        return view('dashboard/backend_index', $data);
    }
}
