<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Auth;
use Response;

class NotificationController extends Controller
{
    //
    public function get(){
        //return view('users.notification');
        return Notification::all();
    }

    public function getNotify(){
        //return view('users.notification');
       // $user = Notification::user(); 
         $notification = Notification::where('notifiable_id', Auth::user()->id)->orderBy('created_at', 'desc')->take(5)->get();
       return Response::json($notification);
    }
}
