<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserEmployee extends Model
{
    use SoftDeletes;

    protected  $table = "user_employee";

    protected  $fillable = [
        "user_id",
        "slug",
        "first_name",
        "last_name",
        "profile",
        "role",
        "phone_number",
        "aadhar_id",
        "email",
        "country_id",
        "state_id",
        "city_id",

    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withDefault();
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id')->withDefault();
    }

    public function state()
    {
        return $this->belongsTo(State::class,'state_id')->withDefault();
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id')->withDefault();
    }

    public function fullName()
    {
        if($this->first_name != null && $this->last_name)
        {
            return ucfirst($this->first_name).' '.$this->last_name;
        }
    }



}
