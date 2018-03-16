<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserCompetition extends Model
{
    //
    use SoftDeletes;

    protected $table = "users_competition";

    public function getRouteKeyName()
    {
        return "slug";
    }

    protected $guarded = ['id','created_at','updated_at','deleted_at'];

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at','desc');
    }

    public function scopeOldestFirst($query)
    {
        return $query->orderBy('created_at','asc');
    }

    public function usersCompetitionsAward()
    {
        return $this->hasMany(\App\UserCompetitionAward::class,'competition_id');
    }

    public function userCompetitionJury()
    {
        return $this->hasMany(UserCompetitionJury::class,'competition_id');
    }

    public function userCompetitionPartner(){
        return $this->hasMany(UserCompetitionPartner::class,"competition_id");
    }

    public function userCompetitionAttachment(){
        return $this->hasMany(UsersCompetitionsAttachment::class,"users_competition_id");
    }

    public function userCompetitionRegistrationType(){
        return $this->hasMany(UserCompetitionRegistrationType::class,"competition_id");
    }

    public function userCompetitionWallQuestion(){
        //return $this->hasMany(UsersCompetitionWallQuestion::class,"users_competition_id")->where("is_announcement","n")->orderBy('id','desc');
        return $this->hasMany(UsersCompetitionWallQuestion::class,"users_competition_id")->orderBy('id','desc');
    }
    public function userCompetitionSubmission(){
        return $this->hasMany(UserCompetitionDesignSubmition::class,"competition_id");
    }

    public function usersCompetitionDesignSubmitionAward()
    {
        return $this->hasMany(UsersCompetitionDesignSubmitionAward::class,"competition_id")
            ->orderBy("created_at","desc");
    }
    public function usersCompetitionDesignSubmitionAwardItem()
    {
        return $this->hasMany(UsersCompetitionDesignSubmitionAwardItem::class,"competition_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}