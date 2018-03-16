<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCompetitionAward extends Model
{
    protected $table = "users_competitions_award";

    protected $guarded = ['id'];
}
