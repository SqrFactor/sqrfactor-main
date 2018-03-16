<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCompetitionJury extends Model
{
    protected $table = "users_competitions_jury";

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class,'jury_id');
    }
}
