<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersOtherDetail extends Model
{
    protected $table = "users_other_detail";

    protected  $fillable = [
        "user_id",
        "slug",
        "award",
        "award_name",
        "project_name",
        "services_offered",

    ];
}
