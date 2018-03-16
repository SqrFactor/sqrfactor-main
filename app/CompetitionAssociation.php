<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompetitionAssociation extends Model
{
    //
    protected  $table = "competitions_association";

    protected $fillable = [
        "users_competition_id",
        "association",
        "image",
        "slug"

    ];

    public function getRouteKeyName()
    {
        return "slug";
    }
}
