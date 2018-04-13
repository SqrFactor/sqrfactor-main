<?php

namespace App;

use App\Events\BroadcastChat;
use Illuminate\Database\Eloquent\Model;


class Chat extends Model
{
    protected $events = [
        'created'=>BroadcastChat::class
    ];
    
    protected $fillable=['user_from','user_to','chat'];

    public function chat_friend(){
    	return $this->belongsTo(ChatFriend::class);
    }
}
