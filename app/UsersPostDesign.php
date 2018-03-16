<?php

namespace App;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersPostDesign extends Model
{
    use SoftDeletes;
    protected  $table = "users_post_design";

    protected $fillable = [
        "user_id",
        "user_post_id",
        "slug",
        "status",
        "building_program",
        "select_design_type",
        "start_year",
        "end_year",
        "total_budget",
        "currency",
        "location",
        "project_part",
        "competition_link",
        "tags",
        "lat",
        "lng",
        "college_part",
        "college_link",

    ];

    public function user(Request $request)
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
