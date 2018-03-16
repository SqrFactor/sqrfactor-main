<?php
 
namespace App\Http\Controllers\Parse;

use App\ImagesForCompression;
use App\Jobs\CompressImage;
use App\Like;
use App\UsersPost;
use App\UsersPostShare;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;
use Auth;
use File;
use Image;

class PostController extends Controller
{
    //
    public function postSave(Request $request)
    {
        $message = array(
            'description.required' => 'Write some description.',
        );
        $rules = array(
            "description" => "required",
        );

        /* base64 banner image saved*/
        if (!empty($request->image_value)) {

            $bannerImageFileName = md5(time() . rand(0000, 9999)) . ".jpg";
            $bannerImagePath = public_path() . "/img/" . $bannerImageFileName;
            Image::make(file_get_contents($request->image_value))->save($bannerImagePath);
            $bannerImageSave = "img/" . $bannerImageFileName;

            /*image compression*/
            $filepath = public_path('img/' . $bannerImageFileName);
            $saveImageForCompression = new ImagesForCompression();
            $saveImageForCompression->url = $filepath;
            $saveImageForCompression->status = "n";
            $saveImageForCompression->save();
            dispatch(new CompressImage());


        } else {

            $bannerImageSave = null;
        }


        $validation = Validator::make(Input::all(), $rules, $message);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->getMessageBag()->toArray(),
            ]);
        } else {
            $post = UsersPost::create([
                'slug' => str_slug(str_random(20) . "-" . rand(1111, 9999)),
                'user_id' => Auth::id(),
                'type' => 'status',
                'description' => $request->description,
                'image' => $bannerImageSave,
            ]);

        $usersPostShare =    UsersPostShare::create([
                'users_post_id' => $post->id,
                'user_id' => Auth::id(),
            ]);

            $user_like_posts = Like::select("likeable_id")->where('user_id', Auth::id())->get()->toArray();
            $user_like_posts_array = [];
            foreach ($user_like_posts as $user_like_post) {
                array_push($user_like_posts_array, $user_like_post['likeable_id']);
            }

            $post = $post->where("id",$post->id)->first();

            $shared_posts = UsersPostShare::selectRaw("users_post.*,users_post.id as user_post_id, is_shared,(SELECT COUNT(comments.id) FROM comments WHERE commentable_id =users_post_share.id) as comments_count,users_post_share.user_id as shared_user,users_post_share.id as shared_id")
                ->join('users_post','users_post.id','=','users_post_share.users_post_id')
                ->where('users_post_share.id', $usersPostShare->id)
                ->where('users_post_share.user_id',Auth::id())
                ->with('commentsLimited.user','commentsLimited.likes','likes','sharedUser','user')->first();





            /*return response()->json($shared_posts);*/


            echo view('users.partials.news-feed-n-profile-post', [
                'post' => $shared_posts,
                'user_like_posts_array' => array_flip($user_like_posts_array)
            ])->render();
        }
    }

    public function uploadMediumImage(Request $request)
    {
        if (!empty($request->image)) {
            $mediumImageFileName = md5(time() . rand(0000, 9999)) . ".jpg";
            $mediumImagePath = public_path() . "/img/medium/" . $mediumImageFileName;

            Image::make(file_get_contents($request->image))->save($mediumImagePath);

            /*image compression*/
            $filepath = public_path('img/medium/' . $mediumImageFileName);

            $saveImageForCompression = new ImagesForCompression();
            $saveImageForCompression->url = $filepath;
            $saveImageForCompression->status = "n";
            $saveImageForCompression->save();

            dispatch(new CompressImage());

            echo asset("img/medium/" . $mediumImageFileName);
        }
    }
}
