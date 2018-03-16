<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersCompetitionsAttachment extends Model
{
    //

    public $timestamps = false;

    protected $table = "users_competitions_attachment";

    protected $guarded = ['id'];
}
