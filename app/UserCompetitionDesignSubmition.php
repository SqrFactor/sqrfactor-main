<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCompetitionDesignSubmition extends Model
{
    protected $table = "users_competition_design_submition";

    protected $guarded = ['id'];

    public function participation(){
        return $this->hasOne(ParticipateUser::class,"id","competition_participation_id");
    }
    /*public function likes(){
    	return $this->hasMany(Like::class,"likeable_id");
    }*/
    public function likes()
    {
        return $this->morphMany(Like::class,'likeable');
    }
    public function comments()
    {
         return $this->morphMany(Comment::class,'commentable')->orderBy("id","desc");
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function competition(){
        return $this->belongsTo(UserCompetition::class,"competition_id","id");
    }
}
