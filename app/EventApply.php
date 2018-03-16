<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventApply extends Model
{
     protected  $table = "event_apply";
     public $timestamps = false;
     protected $guard = ['id'];

    public function userEventDetail(){
     	return $this->belongsTo(UsersEvent::class,'users_event_id');
    }

    public function user(){
     	return $this->belongsTo(User::class,'user_id');
    }
}
