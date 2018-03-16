<?php

namespace App\Http\Controllers\Auth;

use App\ActivationToken;
use App\Mail\Welcome;
use App\VerifyOtp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\UserRegisteredActivationEmail;
use App\User;
use Auth;
Use Mail;


class ActivationController extends Controller
{
    public function activate($token)
    {
        $token = ActivationToken::where("token",$token)->first();

        //if activation token is null redirect user to home page
        if($token == null){
            return redirect()->to(route("home"));
        }
        

        $update = $token->user()->update([
            'active' => '1',
        ]);

        /*welcome email*/



        $fullName = $token->user->fullName();
        $content = [
            'title'=> 'Hey '.$fullName.',',
            'title2' => 'Greetings from Team SqrFactor,',

            'body'=> 'Welcome to SqrFactor :) My name is Agnim and I'."'".'m the founder of SqrFactor. We have thoughtfully designed this platform for you to learn, explore and stay connected with the community. I hope you will like it.',

            'body2' => 'If there'."'".'s ever anything that I can help you with, please let me know.',

        ];

        $receiverAddress = $token->user->email;

        Mail::to($receiverAddress)->send(new Welcome($content));



        /*send otp*/

        if ($token->user->mobile_number !== null) {
            // generate otp
            $otp = rand(101010, 999999);

            VerifyOtp::create([
                "user_id" => $token->user->id,
                "mobile_number" => $token->user->mobile_number,
                "otp" => $otp,

            ]);


            $body = array(
                "token" => "TcmJjnIq5q",
                "mob" => $token->user->mobile_number,
                "mess" => "Your verification code is" . " " . $otp,
                "sender" => "SQRSMS",
                "route" => '1'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $url = "http://api.fast2sms.com/sms.php?" . http_build_query($body);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $parsed_json = curl_exec($ch);
            $parsed_json = json_decode($parsed_json);
            /* var_dump($parsed_json);*/
            curl_close($ch);
        }
        /* end send otp*/

        if ($update) {
            $token->delete();
            Auth::guard('web')->login($token->user);

            return redirect()->route('profile.edit',['simple'=>'true']);
        } else {
            return redirect()->route('/');
        }


    }

    public function resend(Request $request)
    {
        $user = User::byEmail($request->email)->firstOrFail();

        if ($user->active == '1') {
            return redirect()->route('home');
        }

        event(new UserRegisteredActivationEmail($user));

        return redirect('/login')->withSuccess('Activation email resent.');
    }
}
