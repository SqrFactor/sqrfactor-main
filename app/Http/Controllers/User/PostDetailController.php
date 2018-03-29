<?php

namespace App\Http\Controllers\User;

use App\Like;
use App\UsersPost;
use App\UsersPostShare;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PostDetailController extends Controller
{
    public function postDetail(UsersPost $usersPost)
    {


        $user_like_posts = Like::select("likeable_id")->where('user_id',Auth::id())->get()->toArray();

        $user_like_posts_array = [];
        foreach ($user_like_posts as $user_like_post){
            array_push($user_like_posts_array,$user_like_post['likeable_id']);
        }

        $posts = UsersPostShare::selectRaw("users_post.*,users_post.id as user_post_id, is_shared,(SELECT COUNT(comments.id) FROM comments WHERE commentable_id =users_post_share.id) as comments_count,users_post_share.user_id as shared_user,users_post_share.id as shared_id")
            ->join('users_post','users_post.id','=','users_post_share.users_post_id')
            ->where('users_post_share.users_post_id',$usersPost->id)
            ->with('commentsLimited.likes','commentsLimited.user','likes','sharedUser','user')
            ->first();

            $posts->increment('views');

        return view('users.post-detail',[
            'post' => $posts,
            'user_like_posts_array' =>array_flip($user_like_posts_array),
        ]);
    }
}
