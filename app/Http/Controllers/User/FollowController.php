<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function following(User $user, Request $request)
    {
        if ($request->action == 'followers') {
            $follows = $user->follower()->with('followingUser.portfolioPost','followingUser.posts')->get();
        } elseif ($request->action == 'following') {
            $follows = $user->following()->with('followerUser.portfolioPost','followingUser.posts')->get();
        } else {
            abort(404);
        }

        return view('users.profile-following', compact('follows', 'user'));
    }
}
