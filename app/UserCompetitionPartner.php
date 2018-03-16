<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCompetitionPartner extends Model
{
    //
    protected $table = "users_competitions_partner";

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class,'partner_id');
    }
}
