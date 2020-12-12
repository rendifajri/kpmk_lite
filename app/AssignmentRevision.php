<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentRevision extends Model
{
	protected $table = "assignment_revision";
	protected $fillable = ['assignment_id', 'attachment_id', 'active'];

    public function assignment(){
    	return $this->belongsTo('App\Assignment');
    }
    public function attachment(){
    	return $this->belongsTo('App\Attachment');
    }
}
