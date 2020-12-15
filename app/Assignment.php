<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
	protected $table = "assignment";
	protected $fillable = ['user_id', 'topic_id', 'files', 'locked', 'grade', 'active'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function topic(){
    	return $this->belongsTo('App\Topic');
    }
    public function comment(){
    	return $this->hasMany('App\Comment');
    }
}
