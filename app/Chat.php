<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table="chats";
    protected $fillables=[
    	'user_from',
    	'user_to',
    	'chat'
    ];
}
