<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class OtherProfileController extends Controller
{
    public function viewProfile(User $user)
    {
        $posts = $user->posts;
        return view('users.profile-view',compact('user','posts'));
    }
}
