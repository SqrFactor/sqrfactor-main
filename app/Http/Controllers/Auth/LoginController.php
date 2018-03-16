<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Country;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/news-feed';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $countries = Country::orderBy('name','asc')->get();
        
        return view('sqrfactor.loginRegister',["type" => "login","countries" => $countries]);
    }

    public function logout()
    {
        Auth::guard('web')->logout();


       /* return redirect()->to('login?active=login');*/
       return redirect()->to('/login');

    }


    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {

        //
        if($user->active)
        {
            Auth::logout();

            return redirect('login')->with('error','Please account your account.<a href="'.route('auth.activate.resend').'?email='.$user->email.'"> Resend</a>');
        }
    }
}
