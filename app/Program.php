<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = "program";
    protected $fillable = ['name', 'image', 'files', 'description', 'active'];
    
    public function topic(){
    	return $this->hasMany('App\Topic');
    }
}
