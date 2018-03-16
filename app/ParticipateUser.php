<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParticipateUser extends Model
{
    //

    protected $table = 'users_competitions_participate_user';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function designSubmission(){
        return $this->belongsTo(UserCompetitionDesignSubmition::class);
    }

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
}
