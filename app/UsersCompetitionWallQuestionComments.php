<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersCompetitionWallQuestionComments extends Model
{
    protected $table = "users_competition_wall_question_comments";

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
