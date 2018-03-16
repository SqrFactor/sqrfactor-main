<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Jobs\CompressImage;
use App\Like;
use App\UsersPost;
use App\UsersPostShare;
use Auth;
use DB;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use App\UserCompetition;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Image;


class NewsFeedController extends Controller
{
    public function home()
    {

        $followerUsers = Auth::user()->following()->get();
        $followerUsers_arrayPush = [];

        foreach ($followerUsers as $follower) {
            array_push($followerUsers_arrayPush, $follower->to_user);
        }

        $user = [Auth::id()];

        $usersArraymarge = array_merge($user, $followerUsers_arrayPush);

        $user_like_posts = Like::select("likeable_id")->where('user_id', Auth::id())->get()->toArray();
        $user_like_posts_array = [];
        foreach ($user_like_posts as $user_like_post) {
            array_push($user_like_posts_array, $user_like_post['likeable_id']);
        }

        $shared_posts = UsersPostShare::selectRaw("users_post.*,users_post.id as user_post_id, is_shared,(SELECT COUNT(comments.id) FROM comments WHERE commentable_id =users_post_share.id) as comments_count,users_post_share.user_id as shared_user,users_post_share.id as shared_id")
            ->join('users_post', 'users_post.id', '=', 'users_post_share.users_post_id')
            ->whereIn('users_post_share.user_id', $usersArraymarge)
            ->with('commentsLimited.user', 'commentsLimited.likes', 'likes', 'sharedUser', 'user')
            ->orderBy('users_post_share.id', 'desc')->paginate(15);
        //dd($shared_posts[0]);
        return view('users.news-feed', [
            'posts' => $shared_posts,
            'user_like_posts_array' => array_flip($user_like_posts_array)
        ]);
    }

    public function homeHttp()
    {

        $followerUsers = Auth::user()->following()->get();
        $followerUsers_arrayPush = [];

        foreach ($followerUsers as $follower) {
            array_push($followerUsers_arrayPush, $follower->to_user);
        }

        $user = [Auth::id()];

        $usersArraymarge = array_merge($user, $followerUsers_arrayPush);

        $user_like_posts = Like::select("likeable_id")->where('user_id', Auth::id())->get()->toArray();
        $user_like_posts_array = [];
        foreach ($user_like_posts as $user_like_post) {
            array_push($user_like_posts_array, $user_like_post['likeable_id']);
        }

        /*  $posts = UsersPost::selectRaw("*,(SELECT COUNT(comments.id) FROM comments WHERE commentable_id =users_post.id) as comments_count")
              ->whereIn('users_post.user_id', $usersArraymarge)
              ->with('commentsLimited.likes','commentsLimited.user','likes','user')
              ->orderBy('users_post.created_at', 'desc')->simplePaginate(25);*/

        $posts = UsersPostShare::selectRaw("users_post.*,users_post.id as user_post_id, is_shared,(SELECT COUNT(comments.id) FROM comments WHERE commentable_id =users_post.id) as comments_count,users_post_share.user_id as shared_user,users_post_share.id as shared_id")
            ->join('users_post', 'users_post.id', '=', 'users_post_share.users_post_id')
            ->whereIn('users_post_share.user_id', $usersArraymarge)
            ->with('commentsLimited.user', 'commentsLimited.likes', 'likes', 'sharedUser', 'user')
            ->orderBy('users_post_share.id', 'desc')->simplePaginate(25);

        //Html views
        if ($posts->count() > 0) {
            foreach ($posts as $post) {
                echo view("users.partials.news-feed-n-profile-post", [
                    'post' => $post,
                    'user_like_posts_array' => array_flip($user_like_posts_array)
                ])->render();
            }
        }else{
            echo "";
        }
    }

    /*
     * Method to fetch top most Liked posts
     *
     * Husain Saify - 30 Sep 17 / 11:26 PM
     * */
    public function whatsRed()
    {
        //query to get most liked posts
        $likeable = 'App\\\\UsersPostShare';


        /* $q = DB::table("users_post")
             ->select("id", DB::raw("(SELECT count(likeable_id) FROM likes WHERE likeable_id=users_post.id AND `likeable_type` = '".$likeable."') as likes_count"))
             ->where(DB::raw("(SELECT count(likeable_id) FROM likes WHERE likeable_id=users_post.id AND `likeable_type` = '".$likeable."')"),">","0")
             ->orderBy("likes_count", "DESC")
             ->get();*/

        /*UsersPostShare::selectRaw("users_post.*,users_post.id as user_post_id, is_shared,(SELECT COUNT(comments.id) FROM comments WHERE commentable_id =users_post_share.id) as comments_count,users_post_share.user_id as shared_user,users_post_share.id as shared_id")*/


        $q = UsersPostShare::selectRaw("users_post.*,(SELECT count(likeable_id) FROM likes WHERE likeable_id=users_post.id AND `likeable_type` = '" . $likeable . "') as likes_count,users_post.id as user_post_id, is_shared,(SELECT COUNT(comments.id) FROM comments WHERE commentable_id =users_post_share.id) as comments_count,users_post_share.user_id as shared_user,users_post.id as shared_id")
            ->join('users_post', 'users_post.id', '=', 'users_post_share.users_post_id')
            ->where(DB::raw("(SELECT count(likeable_id) FROM likes WHERE likeable_id=users_post.id AND `likeable_type` = '" . $likeable . "')"), ">", "0")
            ->with('commentsLimited.likes', 'commentsLimited.user', 'likes', 'sharedUser', 'user')
            ->orderBy("likes_count", "DESC")->simplePaginate(25);


        //remove Like_count from array
        /*$post_ids = $q->pluck('id')->toArray();

        //convert post id array to a comma sepreated string
        $post_ids_string = implode(",", $post_ids);

        if($post_ids_string != "")
        {
            //Finding post with WhereIN & ordering post using Field
            $usersPOst = UsersPost::whereIn('id', $post_ids)
                ->orderByRaw("FIELD(id," . $post_ids_string . ")")
                ->with('commentsLimited.likes','commentsLimited.user','likes','user')
                ->simplePaginate(25);
        }
        else{
            $usersPOst = null;
        }*/

        $user_like_posts = Like::select("likeable_id")->where('user_id', Auth::id())->get()->toArray();
        $user_like_posts_array = [];
        foreach ($user_like_posts as $user_like_post) {
            array_push($user_like_posts_array, $user_like_post['likeable_id']);
        }

        return view('users.whats-red', [
            'posts' => $q,
            'user_like_posts_array' => array_flip($user_like_posts_array)
        ]);
    }

    public function whatsRedHttp()
    {
        //query to get most liked posts
        $likeable = 'App\\\\UsersPostShare';

        /*$q = DB::table("users_post")
            ->select("id", DB::raw("(SELECT count(likeable_id) FROM likes WHERE likeable_id=users_post.id AND `likeable_type` = '".$likeable."') as likes_count"))
            ->where(DB::raw("(SELECT count(likeable_id) FROM likes WHERE likeable_id=users_post.id AND `likeable_type` = '".$likeable."')"),">","0")
            ->orderBy("likes_count", "DESC")
            ->get();

        //remove Like_count from array
        $post_ids = $q->pluck('id')->toArray();

        //convert post id array to a comma sepreated string
        $post_ids_string = implode(",", $post_ids);

        if($post_ids_string != "")
        {
            //Finding post with WhereIN & ordering post using Field
            $usersPOst = UsersPost::whereIn('id', $post_ids)
                ->orderByRaw("FIELD(id," . $post_ids_string . ")")
                ->with('commentsLimited.likes','commentsLimited.user','likes','user')
                ->simplePaginate(25);
        }
        else{
            $usersPOst = null;
        }*/

        $usersPOst = UsersPostShare::selectRaw("users_post.*,(SELECT count(likeable_id) FROM likes WHERE likeable_id=users_post.id AND `likeable_type` = '" . $likeable . "') as likes_count,users_post.id as user_post_id, is_shared,(SELECT COUNT(comments.id) FROM comments WHERE commentable_id =users_post.id) as comments_count,users_post_share.user_id as shared_user,users_post.id as shared_id")
            ->join('users_post', 'users_post.id', '=', 'users_post_share.users_post_id')
            ->where(DB::raw("(SELECT count(likeable_id) FROM likes WHERE likeable_id=users_post.id AND `likeable_type` = '" . $likeable . "')"), ">", "0")
            ->with('commentsLimited.likes', 'commentsLimited.user', 'likes', 'sharedUser', 'user')
            ->orderBy("likes_count", "DESC")->simplePaginate(25);

        $user_like_posts = Like::select("likeable_id")->where('user_id', Auth::id())->get()->toArray();
        $user_like_posts_array = [];
        foreach ($user_like_posts as $user_like_post) {
            array_push($user_like_posts_array, $user_like_post['likeable_id']);
        }

        //Html views
        if ($usersPOst->count() > 0) {
            foreach ($usersPOst as $post) {
                echo view("users.partials.news-feed-n-profile-post", [
                    'post' => $post,
                    'user_like_posts_array' => array_flip($user_like_posts_array)
                ])->render();
            }
        }else{
            echo "";
        }
    }

    public function postStatusGet(UsersPost $usersPost)
    {
        return view('users.post-status-edit', compact('usersPost'));
    }

    public function postArticleGet(UsersPost $usersPost)
    {
        return view('users.post-article-edit', compact('usersPost'));
    }

    public function postDesignGet(UsersPost $usersPost)
    {

        return view('users.post-design-edit', compact('usersPost'));
    }

    public function postDesignPost(UsersPost $usersPost, Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'image' => 'required'
        ]);

    }
}
