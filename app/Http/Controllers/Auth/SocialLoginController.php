<?php

namespace App\Http\Controllers\Auth;

use App\Mail\Welcome;
use App\User;
use Socialite;
use App\Http\Requests;
use App\UserDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

use Auth;

class SocialLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['social', 'guest']);
    }

    public function redirect(Request $request, $service)
    {

        return Socialite::driver($service)->redirect();
    }

    public function callback(Request $request, $service)
    {
        if ($request->has('access_denied') || $request->has('error_reason')) {
            return redirect('/');
        }

        $serviceUser = Socialite::driver($service)->stateless()->user();

        $fullname = explode(' ', $serviceUser->getName());

        $user = $this->getExistingUser($serviceUser, $service);

        if (!$user) {
            if ($serviceUser->getEmail() !== null) {
                $email = $serviceUser->getEmail();
            } else {
                $email = null;
            }

            $user = User::create([
                'first_name' => $fullname[0],
                'last_name' => $fullname[1],
                'email' => $email,
                'profile' => $serviceUser->getAvatar(),
                'active' => true
            ]);

            UserDetail::create([
                'slug' => str_slug(str_random(20) . "-" . rand(1111, 9999)),
                'user_id' => $user->id,
            ]);

            if ($serviceUser->getEmail() != null){

                /*welcome email*/

                $fullName = ucfirst($fullname[0]).' '.ucfirst($fullname[1]);
                $content = [
                    'title'=> 'Hey '.$fullName.',',
                    'title2' => 'Greetings from Team SqrFactor,',

                    'body'=> 'Welcome to SqrFactor :) My name is Agnim and I'."'".'m the founder of SqrFactor. We have thoughtfully designed this platform for you to learn, explore and stay connected with the community. I hope you will like it.',

                    'body2' => 'If there'."'".'s ever anything that I can help you with, please let me know.',

                ];
                $receiverAddress = $email;
                Mail::to($receiverAddress)->send(new Welcome($content));
            }
        }

        if ($this->needsToCreateSocial($user, $service)) {
            $user->social()->create([
                'social_id' => $serviceUser->getId(),
                'service' => $service,
            ]);
        }

        Auth::login($user, false);

        if(Auth::user()->userSocial()->count() =='1')
        {
            return redirect()->route('home');
        }
        else
        {
            return redirect()->intended('/profile/edit?simple=true');
        }


    }

    protected function needsToCreateSocial(User $user, $service)
    {
        return !$user->hasSocialLinked($service);
    }

    protected function getExistingUser($serviceUser, $service)
    {
        return User::where('email', $serviceUser->getEmail())->orWhereHas('social', function ($q) use ($serviceUser, $service) {

            $q->where('social_id', $serviceUser->getId())->where('service', $service);


        })->first();
    }

    public function needsToFailDetail()
    {

    }
}