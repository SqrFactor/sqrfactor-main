<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\BroadcastChat;

class Chat extends Model
{
    protected $dispatchesEvents = [
        'created'=>BroadcastChat::class
    ];
    
    protected $fillable=[
    	'user_from',
    	'user_to',
    	'conversation_id',
    	'chat'
    ];
}
