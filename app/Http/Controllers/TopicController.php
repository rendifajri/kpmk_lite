<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Program;
use App\Topic;

class TopicController extends Controller
{
    public function index(Request $request){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $data['request'] = $request;
        $data['title'] = 'Topic';

        $data['program'] = Program::orderBy('name')->get();
        $data['topic'] = Topic::orderBy('name')->get();
        return view('topic/index', $data);
    }
    public function add_post(Request $request){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $active = $request->active != null ? 1 : 0;
        $password = md5($request->password);
        $data = [
                    'program_id' => $request->program_id,
                    'name' => $request->name,
                    'description' => $request->description,
                    'active' => $active
                ];
        $id = Topic::create($data)->id;
        $folder = "files/topic";
        $files = $request->file('data_files');
        $files_name = [];
        $i = 0;
        if($request->hasFile('data_files')){
            foreach ($files as $file) {
                //$files_name[$i] = $request->id."_".$i.".".$file->getClientOriginalExtension();
                $files_name[$i] = $file->getClientOriginalName();
                $i++;
                $file->move($folder, $files_name[$i]);
            }
            unset($data);
            $data['files'] = implode(',', $files_name);
            Topic::find($id)->update($data);
        }
        return redirect('backend/topic');
    }
    public function edit_post(Request $request){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $active = $request->active != null ? 1 : 0;
        $data = [
                    'program_id' => $request->program_id,
                    'name' => $request->name,
                    'description' => $request->description,
                    'active' => $active
                ];
        $folder = "files/topic";
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
        $topic = Topic::find($request->id)->update($data);
        return redirect('backend/topic');
    }

    public function delete(Request $request, $id){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $topic = Topic::find($id)->update(['active' => 0]);
        return redirect('backend/topic');
    }

}
