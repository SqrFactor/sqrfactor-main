<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversations_Msg extends Model
{
    //
    protected $table="messages";
    protected $fillable=[
    	'user_one',
    	'user_two',
      	
    ];

    public function MessagesConv(){
      return $this->belongToMany('App\MessagesConv')::where('user_to', '!=', Auth::user()->id);
    }

    

}
