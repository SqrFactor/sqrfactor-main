<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UsersPost;
use Auth;

class ArticlePostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function articlePostAdd()
    {
        return view('users.article');
    }

    public function articlePostSave(Request $request)
    {
        $message = array(
            "design_title.required" => "The title field is required",
            "design_description.required" => "fThe description field is required",
        );

        $this->validate($request, [
            "design_title" => "required",
            "design_description" => "required",
        ], $message);

        UsersPost::create([
            "slug" => str_slug(str_random(20) . "-" . rand(1111, 9999)),
            "type" => "Article",
            "user_id" => Auth::id(),
            "title" => $request->design_title,
            "description" => $request->design_description,

        ]);

        return redirect()->route('statusPOst.add')->withSuccess("Post has been saved successfully.");
    }
}
