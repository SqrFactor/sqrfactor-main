<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetitionImage extends Model
{
    use SoftDeletes;
    protected $table = "competitions_image";

    protected $fillable = [
        "slug",
        "users_competition_id",
        "image",

    ];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at','desc');
    }

    public function scopeOldestFirst($query)
    {
        return $query->orderBy('created_at','asc');
    }


}
