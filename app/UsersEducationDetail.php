<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersEducationDetail extends Model
{
    use SoftDeletes;
    protected $table = "users_education_detail";

    protected $fillable = [
        "user_id",
        "slug",
        "course",
        "college_university",
        "year_of_admission",
        "year_of_graduation",

    ];
    
    public function usersCollege(){
        return $this->belongsTo(User::class,'college_university_id','id')->where('user_type','work_architecture_college');
    }


}
