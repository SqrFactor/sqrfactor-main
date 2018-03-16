<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ProfilePictureController extends Controller
{

    //method to get profile picture
    public function get(User $user)
    {

        if (empty($user->password)){
            //He has logged in with google or facebook
            $remoteImage = $user->profile;

            $imginfo = getimagesize($remoteImage);

            header("Content-type: {$imginfo['mime']}");

            ob_clean();

            flush();

            readfile($remoteImage);
        }else{
            //Normal login

            //get file extension
            $file = $user->profile;
            $file_ext = explode(".", $file)[1];
            $file_ext = strtolower($file_ext);

            if ($file_ext == "jpg") {
                $img = imagecreatefromjpeg($file);
                header("Content-Type: image/jpg");
                imagejpeg($img);
                imagedestroy($img);
            }else{
                $img = imagecreatefrompng($file);
                header("Content-Type: image/png");
                imagepng($img);
                imagedestroy($img);
            }
        }
    }
     


}
