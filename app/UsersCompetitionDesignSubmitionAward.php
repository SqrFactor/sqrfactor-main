<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersCompetitionDesignSubmitionAward extends Model
{
    protected $table = "users_competition_design_submition_award";

    protected $guarded = ['id'];
   
    public function usersCompetitionDesignSubmitionAwardItem()
    {
        return $this->hasMany(UsersCompetitionDesignSubmitionAwardItem::class, "users_competition_design_submition_award_id");
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
