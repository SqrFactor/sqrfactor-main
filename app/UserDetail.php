<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    //
    protected $table = "user_detail";

    protected $fillable = [
              'slug' ,
             'user_id',
        "date_of_birth",
        'phone_number' ,
        'aadhar_id'  ,
        'address'    ,
        'occupation'  ,
        'pin_code' ,
        'country_id'  ,
        'state_id'   ,
        'city_id'    ,
        'short_bio'   ,
        'facebook_link' ,
        'twitter_link'  ,
        'linkedin_link' ,
        'instagram_link',
        'looking_for_an_architect',
        'gender',
        'occupation',
        'name_of_the_company',
        'business_description',
        'types_of_firm_company',
        'firm_or_company_name',
        'firm_or_company_registration_number',
        'company_firm_or_college_university',

        'role',
        'employee_first_name',
        'employee_last_name',
        'describe_yourself',
        'course',
        'college_university',
        'year_of_admission',
        'year_of_graduation',
        'years_in_service',
        'award',
        'award_name',
        'project_name',
        'salary_stripend',
        'services_offered',
        'see_buildtrail',
        'salary_stripend_other_details',
        'year_in_service',
        'services_offered',
        'firm_size',
        'asset_served',
        'city_served'

    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withDefault();
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
