<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;


class Message_Conv extends Model
{
    //

    protected $table="messages";
    public $timestamps = false;
    protected $fillable=[
    	'user_from',
    	'user_to',
      'conversation_id',
      	'msg_db', 
      	'status',
    ];

     public function ConversationsOfMine(){
        return $this->belongsToMany('App\User','conversations','user_one','user_two');
    }

    public function users(){
   	return $this->hasMany('App\Users');
  }

    public function scopeUser_To_Model($query)
    {
        return $query->where('user_to', '!=', Auth::user()->id);
    }

    

}
