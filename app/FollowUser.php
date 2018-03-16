<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowUser extends Model
{
    //

    protected $table = "follow_user";

    protected $fillable = [
        "from_user",
        "to_user",
    ];

    public function followerUser()
    {
        return $this->belongsTo(User::class, 'to_user');
    }

    public function followingUser()
    {
        return $this->belongsTo(User::class, 'from_user');
    }
}
