<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Comment;


class Comment extends Model
{

    protected $table = "comments";



    protected  $fillable = [
        'user_id',
        'commentable_id',
        'commentable_type',
        'body'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withDefault();
    }

    public function usersPost()
    {
        return $this->belongsTo(UsersPost::class,'commentable_id')->withDefault();
    }

    public function likes()
    {
        return $this->morphMany(Like::class,'likeable');
    }

    public function isThisLike($likeable_id)
    {
        return Like::where('user_id',Auth::id())->where('likeable_id',$likeable_id)->first();
    }

     

}
