<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersCompetitionDesignSubmitionAwardItem extends Model
{
    protected $table = "users_competition_design_submition_award_item";

    protected $guarded = ['id'];
   

    public function usersCompetitionDesignSubmitionAward()
    {
        return $this->belongsTo(UsersCompetitionDesignSubmitionAward::class, "id");
    }

    public function usersCompetitionsAward()
    {
        return $this->belongsTo(UserCompetitionAward::class, "result_id");
    }

    public function usersCompetitionsDesign(){
        return $this->belongsTo(UserCompetitionDesignSubmition::class,"design_id");
    }
}
