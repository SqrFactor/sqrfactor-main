<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersEmail extends Model
{
    //

    protected $table = 'users_email';

    protected $fillable = [
        "user_id",
        "email",
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
