<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
	protected $table = "topic";
	protected $fillable = ['program_id', 'image', 'name', 'files', 'description', 'active'];

    public function program(){
    	return $this->belongsTo('App\Program');
    }
    public function assignment(){
    	return $this->hasMany('App\Assignment');
    }
}
