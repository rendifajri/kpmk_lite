<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
	protected $table = "attachment";
	protected $fillable = ['files', 'active'];

    public function assigment(){
    	return $this->hasMany('App\Assigment');
    }
    public function assigment_revision(){
    	return $this->hasMany('App\AssigmentRevision');
    }
}
