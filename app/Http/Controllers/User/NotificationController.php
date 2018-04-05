<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Notification;

class NotificationController extends Controller
{
    public function get(){
        return view('users.notification');
        //return Notification::all();
    }
}
