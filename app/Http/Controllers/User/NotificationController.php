<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function get(){
        return view('users.notification');
    }
}
