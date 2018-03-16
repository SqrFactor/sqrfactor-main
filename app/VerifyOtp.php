<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class VerifyOtp extends Model
{


    protected  $table = "verify_otp";

    protected  $fillable = [
        "user_id",
        "otp",
        "mobile_number",
    ];
}
