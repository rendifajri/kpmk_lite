<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assigment extends Model
{
	protected $table = "assigment";
	protected $fillable = ['user_id', 'topic_id', 'attachment_id', 'grade', 'active'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function topic(){
    	return $this->belongsTo('App\Topic');
    }
    public function attachment(){
    	return $this->belongsTo('App\Attachment');
    }
    public function assigment_revision(){
    	return $this->hasMany('App\AssigmentRevision');
    }
}
