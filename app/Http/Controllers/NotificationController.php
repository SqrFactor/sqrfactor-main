<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;

class NotificationController extends Controller
{
    //
    public function get(){
        //return view('users.notification');
        return Notification::all();
    }
}
