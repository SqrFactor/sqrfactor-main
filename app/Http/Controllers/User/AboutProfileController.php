<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutProfileController extends Controller
{

    public function aboutProfile(User $user)
    {
        return view('users.profile-about',compact('user'));
    }
}
