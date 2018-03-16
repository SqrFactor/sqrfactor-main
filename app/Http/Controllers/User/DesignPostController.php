<?php

namespace App\Http\Controllers\User;

use App\ImagesForCompression;
use App\Jobs\CompressImage;
use App\UsersPostDesign;
use App\UsersPostShare;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UsersPost;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class DesignPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function designPostAdd()
    {
        return view('users.design');
    }

    public function designPostSave(Request $request)
    {
        $message = array(
            "design_title.required" => "The title field is required",
            "design_description.required" => "The description field is required",
            "design_description.min" => "The description field is required",
        );

        $this->validate($request, [
            "design_title" => "required",
            "design_description" => "required|min:40",
        ], $message);

        UsersPost::create([
            "slug" => str_slug(str_random(15) . "-" . rand(1111, 9999)),
            "type" => "Design",
            "user_id" => Auth::id(),
            "title" => $request->design_title,
            "description" => $request->design_description,

        ]);

        return redirect()->route('statusPOst.add')->withSuccess("Post has been saved successfully.");
    }

    public function designPostSaveAjax(Request $request)
    {
        $message = array(
            "title.required" => "The title field is required.",
            "description.required" => "The description field is required.",
            "description.min" => "The description field is required.",
            "formatted_address.required" => "Address field is required.",
            'description_short.required' => "short description field is required.",
        );

        $rules = array(
            "title" => "required",
            "description" => "required|min:16",
            'formatted_address' => 'required',
            'description_short' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'return' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        return response()->json([
            'oneFormData' => [
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->post_type,
                'formatted_address' => $request->formatted_address,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'description_short' => $request->description_short,
            ]
        ]);


    }

    /*post design 2*/
    public function designPostSaveAjax2(Request $request)
    {

        $message = array(
            "oldTitle.required" => "The Title field is required",
            "oldDescription.required" => "The Description field is required",
            "OldDescription.min" => "The Description field should be a min of 16 character",
            "banner_image.required" => "The banner image field is required"
        );

        $rules = array(
            "oldTitle" => "required",
            "oldDescription" => "required|min:16",
            "status" => 'required',
          /*  "building_program" => 'required',
            "start_year" => 'required',
            "end_year" => 'required',
            "total_budget" => 'required',
            "inr" => 'required',
            "project_part" => 'required',
            "tags" => 'required',
            'banner_image' => 'required',*/
            "select_design_type" => 'required',

        );

        $validator = Validator::make(Input::all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        /* base64 banner image saved*/
        if (!empty($request->banner_image)) {

            $bannerImageFileName = md5(time() . rand(0000, 9999)) . ".jpg";
            $bannerImagePath = public_path() . "/img/" . $bannerImageFileName;
            Image::make(file_get_contents($request->banner_image))->save($bannerImagePath);
            $bannerImageSave = "img/" . $bannerImageFileName;


            /*image compression*/
            $filepath = public_path('img/'.$bannerImageFileName);
            $saveImageForCompression = new ImagesForCompression();
            $saveImageForCompression->url = $filepath;
            $saveImageForCompression->status = "n";
            $saveImageForCompression->save();
            dispatch(new CompressImage());

        } else {

            $bannerImageSave = null;
        }

        /*end base64 banner image saved*/

        $userpost = UsersPost::create([
            "slug" => str_slug(str_limit($request->oldTitle,15) . " " . rand(10111, 90999)),
            "type" => $request->oldType,
            "user_id" => Auth::id(),
            "title" => $request->oldTitle,
            "description" => $request->oldDescription,
            'short_description' => $request->oldDescription_short,
            'banner_image' => $bannerImageSave
        ]);

        if($request->building_program == "")
        {
           $building_program = NULL;

        }
        else
        {
            $building_program = $request->building_program;

        }

        UsersPostShare::create([
            'users_post_id' => $userpost->id,
            'user_id' => Auth::id(),
        ]);


        UsersPostDesign::create([
            'user_id' => Auth::id(),
            'user_post_id' => $userpost->id,
            'status' => $request->status,
            'select_design_type' => $request->select_design_type,
            'building_program' => $building_program,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'total_budget' => $request->total_budget,
            'currency' => $request->inr,
            'location' => $request->oldFormatted_address,
            'lat' => $request->oldLat,
            'lng' => $request->oldLng,
            'project_part' => $request->project_part_val,
            'competition_link' => $request->competition_link,
            'college_part' => $request->college_part_val,
            'college_link' => $request->college_link,
            'tags' => $request->tags,
        ]);

        return response()->json([
            'successMsg' => 'Saved Successfully.',
        ]);
    }


    public function designPostSaveAjax2Edit(Request $request)
    {



        $userpost_r = UsersPost::where('slug',$request->slug)->where('user_id',Auth::id())->first();

        $message = array(
            "oldTitle.required" => "The Title field is required",
            "oldDescription.required" => "The Description field is required",
            "OldDescription.min" => "The Description field should be a min of 16 character",
            "banner_image.required" => "The banner image field is required"
        );

        $rules = array(
            "oldTitle" => "required",
            "oldDescription" => "required|min:16",
            "status" => 'required',
            /*"building_program" => 'required',
            "start_year" => 'required',
            "end_year" => 'required',
            "total_budget" => 'required',
            "inr" => 'required',
            "project_part" => 'required',
            "tags" => 'required',*/
            "select_design_type" => 'required',

        );

        $validator = Validator::make(Input::all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        if ($request->hasFile('image')) {
            $file = $request->image;
            $file_extention = $file->getClientOriginalExtension();
            $file_name = str_random(10) . time() . '.' . $file_extention;

            Storage::disk("public")->put('images/' . $file_name, File::get($request->file('image')));

            $bannerImageSave = 'storage/images/' . $file_name;

            /*image compression*/
            $filepath = public_path('storage/images/'.$file_name);
            $saveImageForCompression = new ImagesForCompression();
            $saveImageForCompression->url = $filepath;
            $saveImageForCompression->status = "n";
            $saveImageForCompression->save();
            dispatch(new CompressImage());
        } else {
            $bannerImageSave = $userpost_r->banner_image;
        }

        /*end base64 banner image saved*/



        $userpost = UsersPost::where('id',$userpost_r->id)->update([
            "slug" => str_slug(str_limit($request->oldTitle,15) . " " . rand(10111, 90999)),
            "type" => $request->oldType,
            "user_id" => Auth::id(),
            "title" => $request->oldTitle,
            "description" => $request->oldDescription,
            'short_description' => $request->oldDescription_short,
            'banner_image' => $bannerImageSave
        ]);

        if($request->building_program == "")
        {
            $building_program = NULL;

        }
        else
        {
            $building_program = $request->building_program;

        }





        UsersPostDesign::where('user_post_id',$userpost_r->id)->update([
            'status' => $request->status,
            'select_design_type' => $request->select_design_type,
            'building_program' => $building_program,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'total_budget' => $request->total_budget,
            'currency' => $request->inr,
            'location' => $request->oldFormatted_address,
            'lat' => $request->oldLat,
            'lng' => $request->oldLng,
            'project_part' => $request->project_part_val,
            'competition_link' => $request->competition_link,
            'college_part' => $request->college_part_val,
            'college_link' => $request->college_link,
            'tags' => $request->tags,
        ]);



        return response()->json([
            'successMsg' => 'Saved Successfully.',
        ]);
    }
    /*end post design 2*/


    /*post article save*/

    public function articlePostSaveAjax(Request $request)
    {
        $message = array(
            "title.required" => "The title field is required",
            "description.required" => "The description field is required",
            "description.min" => "The description field is required",
            "banner_image.required" => "The banner image field is required",
            'description_short.required' => 'The short description  field is required'
        );

        $rules = array(
            "title" => "required",
            "description" => "required|min:16",
            "banner_image" => "required",
            'description_short' => "required",
        );

        $validator = Validator::make(Input::all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'return' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        } else {

            /* base64 banner image saved*/
            if (!empty($request->banner_image)) {

                $bannerImageFileName = md5(time() . rand(0000, 9999)) . ".jpg";
                $bannerImagePath = public_path() . "/img/" . $bannerImageFileName;
                Image::make(file_get_contents($request->banner_image))->save($bannerImagePath);
                $bannerImageSave = "img/" . $bannerImageFileName;


                /*image compression*/
                $filepath = public_path('img/'.$bannerImageFileName);
                $saveImageForCompression = new ImagesForCompression();
                $saveImageForCompression->url = $filepath;
                $saveImageForCompression->status = "n";
                $saveImageForCompression->save();
                dispatch(new CompressImage());




            } else {

                $bannerImageSave = null;
            }

            /*end base64 banner image saved*/

          $usersPost =  UsersPost::create([
                "slug" => str_slug(str_limit($request->title,25) . "-" . rand(1111, 9999)),
                "type" => $request->post_type,
                "user_id" => Auth::id(),
                "title" => $request->title,
                "description" => $request->description,
                'banner_image' => $bannerImageSave,
                "short_description" => $request->description_short,
            ]);

            UsersPostShare::create([
                'users_post_id' => $usersPost->id,
                'user_id' => Auth::id(),
            ]);

            return response()->json([
                'return' => true,
                'success' => 'Post has been saved successfully.'
            ]);

        }

    }

    public function articlePostSaveAjaxEdit(Request $request)
    {
      $usersPost = UsersPost::where('slug',$request->slug)->first();

        $message = array(
            "title.required" => "The title field is required",
            "description.required" => "The description field is required",
            "description.min" => "The description field is required",
            "banner_image.required" => "The banner image field is required",
            'description_short.required' => 'The short description  field is required'
        );

        $rules = array(
            "title" => "required",
            "description" => "required|min:16",

            'description_short' => "required",
        );

        $validator = Validator::make(Input::all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'return' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        } else {

            /* base64 banner image saved*/
            if (!empty($request->banner_image)) {

                $bannerImageFileName = md5(time() . rand(0000, 9999)) . ".jpg";
                $bannerImagePath = public_path() . "/img/" . $bannerImageFileName;
                Image::make(file_get_contents($request->banner_image))->save($bannerImagePath);
                $bannerImageSave = "img/" . $bannerImageFileName;
                /*image compression*/
                $filepath = public_path('img/'.$bannerImageFileName);
                $saveImageForCompression = new ImagesForCompression();
                $saveImageForCompression->url = $filepath;
                $saveImageForCompression->status = "n";
                $saveImageForCompression->save();
                dispatch(new CompressImage());
            } else {

                $bannerImageSave = $usersPost->banner_image;
            }

            /*end base64 banner image saved*/

            UsersPost::where('slug',$request->slug)->where('user_id',Auth::id())->update([
                "title" => $request->title,
                "description" => $request->description,
                'banner_image' => $bannerImageSave,
                "short_description" => $request->description_short,
            ]);

            return response()->json([
                'return' => true,
                'success' => 'Post has been saved successfully.'
            ]);

        }

    }

}
