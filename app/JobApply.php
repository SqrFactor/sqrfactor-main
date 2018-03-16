<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApply extends Model
{
     protected  $table = "job_apply";
     public $timestamps = false;
     protected $guard = ['id'];

    public function userJobDetail(){
     	return $this->belongsTo(UsersJob::class,'users_job_id');
    }

    public function user(){
     	return $this->belongsTo(User::class,'user_id');
    }
}
