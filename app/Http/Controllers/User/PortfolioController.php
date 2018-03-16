<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
    public function getPortfolio(User $user){
       /* $posts = $user->portfolioUsersPostShare()->with('user','usersPost.user')->get();*/
        $posts = $user->portfolio()->with('usersPostShare.usersPost','user')->get();
        
        return view("users.portfolio",compact('posts','user'));
    }
}
