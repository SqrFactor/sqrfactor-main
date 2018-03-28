<?php

namespace App\Http\Controllers;

use App\User;
use App\Like;
use App\UsersPostShare;
use Illuminate\Http\Request;
use Auth;
use App\ChatFriend;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /* public function __construct()
      {
          $this->middleware('auth:web');
      }*/


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {


        $user_like_posts = Like::select("likeable_id")->where('user_id',Auth::id())->get()->toArray();
        $user_like_posts_array = [];
        foreach ($user_like_posts as $user_like_post){
            array_push($user_like_posts_array,$user_like_post['likeable_id']);
        }
        
      /*  $posts = Auth::user()->posts()
            ->selectRaw("*,(SELECT COUNT(comments.id) FROM comments WHERE commentable_id =users_post.id) as comments_count")
            ->with('commentsLimited.likes','commentsLimited.user','likes','user')
            ->simplePaginate(25);*/

        $posts = UsersPostShare::selectRaw("users_post.*,users_post.id as user_post_id, is_shared,(SELECT COUNT(comments.id) FROM comments WHERE commentable_id =users_post_share.id) as comments_count,users_post_share.user_id as shared_user,users_post_share.id as shared_id")
            ->join('users_post','users_post.id','=','users_post_share.users_post_id')
            ->where('users_post_share.user_id', Auth::id())
            ->with('commentsLimited.likes','commentsLimited.user','likes','sharedUser','user')
            ->orderBy('users_post_share.id', 'desc')->paginate(25);
/*
        dd($posts);*/


        return view('users.profile', [
            'posts' => $posts,
            'user_like_posts_array' =>array_flip($user_like_posts_array)
        ]);
    }

//  //sachin chat
    public function getallMSG(){
        $friends = Auth::user()->friends();
         // return $friends;
        return view('users.all-messanger',compact('friends'));
    }

    public function showAllmsg($id){
        $friend_chat = User::find(106);
        // return $friend_chat;
        return view('users.all-messanger')->with('friend_chat',$friend_chat);
    }

    public function sendMessage(User $user){
        return view('users.message')->with('user',$user);
    }


    public function viewProfile(User $user)
    {
        //if user is logged in & he is on his own profile send him back to /profile
        if (Auth::check() && Auth::user()->username == $user->user_name){
            return redirect()->to(route("profile"));
        }

        $user_like_posts = Like::select("likeable_id")->where('user_id',Auth::id())->get()->toArray();
        $user_like_posts_array = [];
        foreach ($user_like_posts as $user_like_post){
            array_push($user_like_posts_array,$user_like_post['likeable_id']);
        }

       /* $posts = $user
            ->posts()
            ->selectRaw("*,(SELECT COUNT(comments.id) FROM comments WHERE commentable_id =users_post.id) as comments_count")
            ->with('commentsLimited.likes','commentsLimited.user','likes','user')
            ->simplePaginate(25);*/

    /*    $posts = UsersPostShare::selectRaw("users_post.*,users_post.id as user_post_id, is_shared,(SELECT COUNT(comments.id) FROM comments WHERE commentable_id =users_post.id) as comments_count,users_post_share.user_id as shared_user,users_post_share.id as shared_id")
            ->join('users_post','users_post.id','=','users_post_share.users_post_id')
            ->where('users_post_share.user_id', $user->id)
            ->with('commentsLimited.likes','commentsLimited.user','likes','sharedUser','user')
            ->orderBy('users_post_share.id', 'desc')->simplePaginate(25);*/

        $posts = UsersPostShare::selectRaw("users_post.*,users_post.id as user_post_id, is_shared,(SELECT COUNT(comments.id) FROM comments WHERE commentable_id =users_post_share.id) as comments_count,users_post_share.user_id as shared_user,users_post_share.id as shared_id")
            ->join('users_post','users_post.id','=','users_post_share.users_post_id')
            ->where('users_post_share.user_id', $user->id)
            ->with('commentsLimited.user','commentsLimited.likes','likes','sharedUser','user')
            ->orderBy('users_post_share.id', 'desc')->paginate(15);
        
            


        return view('users.profile-view',[
            'user' => $user,
            'posts' => $posts,
            'user_like_posts_array' =>array_flip($user_like_posts_array)
        ]);
    }


    
}