<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersJob extends Model
{
    //
    protected  $table = "users_job";

    protected  $fillable = [
        'slug',
        'user_id',
        "job_title",
        "description",
        "category",
        "type_of_position",
        "work_experience",
        "firm",
        "country_id",
        "salary_type",
        "maximum_salary",
        "minimum_salary",
        "state_id",
        "city_id",
        "job_offer_expires_on",
    ];

    public function getRouteKeyName()
    {
        return "slug";
    }


    public function skills()
    {
        return $this->hasMany(JobSkills::class,"users_job_id");
    }
    public function educationalQualification()
    {
        return $this->hasMany(JobEducationalQualification::class,"users_job_id");
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
}
