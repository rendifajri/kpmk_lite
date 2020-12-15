<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table = "comment";
	protected $fillable = ['user_id', 'assignment_id', 'comment', 'read_status', 'active'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function assignment(){
    	return $this->belongsTo('App\Assignment');
    }
}
