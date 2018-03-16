<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    //use SoftDeletes;
    protected  $table = "likes";

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];

   

    public function likeable()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
}
