<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersCompetitionWallQuestion extends Model
{
    protected $table = "users_competition_wall_question";

    public function user()
    {
        return $this->hasOne(User::class,"id","user_id");
    }

    public function comments()
    {
        return $this->hasMany(UsersCompetitionWallQuestionComments::class,'users_competition_wall_question_id')->orderBy('id','desc');
    }
}
