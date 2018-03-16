<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivationToken extends Model
{
    //
    protected $table = "activation_tokens";

    protected $fillable = ["token",'user_id'];

    public function getRouteKeyName()
    {
        return "token";
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
