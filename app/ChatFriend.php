<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatFriend extends Model
{
    protected $table="chat_friends";
    protected $fillables = ['user_from','user_to'];
}
