<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table = "comment";
	protected $fillable = ['user_id', 'attachment_id', 'comment', 'read_status', 'active'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function attachment(){
    	return $this->hasMany('App\Attachment');
    }
}
