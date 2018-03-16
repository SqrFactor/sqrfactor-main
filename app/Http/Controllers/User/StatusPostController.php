<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class StatusPostController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:web');
    }

    public function statusPostAdd()
    {
        $posts = Auth::user()->posts;
       
        return view('users.status',compact('posts'));
    }
}
