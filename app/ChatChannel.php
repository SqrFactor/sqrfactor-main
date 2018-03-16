<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatChannel extends Model
{
    protected $table = "chat_channel";
    public $timestamps = false;
    protected $guarded = ['id'];

    public function from_user()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function to_user()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
}
