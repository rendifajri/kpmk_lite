<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "user";
    protected $fillable = ['username', 'password', 'temp_password', 'name', 'image', 'email', 'phone', 'type', 'active'];
    
    public function transaction(){
    	return $this->hasMany('App\Transaction');
    }
    public function assignment(){
    	return $this->hasMany('App\Assignment');
    }
}
