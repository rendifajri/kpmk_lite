<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Topic;
use App\Assignment;
use App\Comment;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    public function index(Request $request){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $data['request'] = $request;
        $data['title'] = 'Assignment';

        $data['assignment'] = Assignment::groupBy('topic_id', 'user_id')->get(DB::raw('*, MAX(grade) as grade'));
        return view('assignment/index', $data);
    }
    public function lock(Request $request, $id, $lock, $div_id){
        if($request->session()->get('type') != 'Administrator'){
            return redirect('user/login');
        }
        $assignment = Assignment::find($id);
        $assignment->update(['locked' => $lock]);
        return redirect('program/detail/assignment/'.$assignment->topic->id.'/'.$assignment->user->id.'#'.$div_id);
    }
    public function add_post(Request $request){
        if($request->session()->get('type') != 'User' || $request->user_id != $request->session()->get('id')){
            return redirect('user/login');
        }
        $data = [
                    'user_id' => $request->session()->get('id'),
                    'topic_id' => $request->topic_id,
                    'locked' => 0
                ];
        $id = Assignment::create($data)->id;
        $folder = "files/assignment";
        $files = $request->file('data_files');
        $files_name = [];
        $i = 0;
        if($request->hasFile('data_files')){
            foreach ($files as $file) {
                $files_name[$i] = $request->session()->get('id')." - ".$file->getClientOriginalName();
                //$files_name[$i] = $file->getClientOriginalName();
                $file->move($folder, $files_name[$i]);
                $i++;
            }
            unset($data);
            $data['files'] = implode(',', $files_name);
            Assignment::find($id)->update($data);
        }
        $data = [
                    'user_id' => $request->session()->get('id'),
                    'assignment_id' => $id,
                    'comment' => $request->comment,
                    'read_status' => 0
                ];
        Comment::create($data);
        return redirect('program/detail/assignment/'.$request->topic_id.'/'.$request->user_id.'#inisial');
    }
    public function comment_add_post(Request $request){
        if($request->session()->get('type') != 'Administrator' && $request->user_id != $request->session()->get('id')){
            return redirect('user/login');
        }
        if($request->session()->get('type') == 'Administrator' && $request->grade != ''){
            $data['grade'] = $request->grade;
            Assignment::find($request->assignment_id)->update($data);
        }
        if($request->comment != '<p>.</p>'){
            $data = [
                        'user_id' => $request->session()->get('id'),
                        'assignment_id' => $request->assignment_id,
                        'comment' => $request->comment,
                        'read_status' => 0
                    ];
            Comment::create($data);
        }
        return redirect('program/detail/assignment/'.$request->topic_id.'/'.$request->user_id.'#'.$request->div_id);
    }
}
