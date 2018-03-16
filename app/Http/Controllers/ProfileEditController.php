<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileEditController extends Controller
{
    //
    public function profile()
    {
        return view('users.profile');
    }

    public function index()
    {
        return view('users.partials.hire-work');
    }

}
