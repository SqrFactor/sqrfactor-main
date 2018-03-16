<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    /*use middleware for authentication*/
    public function __construct()
    {
        $this->middleware('guest',['except' => 'adminLogout']);
    }

    /*open login blade file*/
    public function loginGet()
    {
        return view('admin.login');
    }

    /*login as a admin*/
    public function loginPost(Request $request)
    {
        $this->Validate($request,[
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:6'
        ]);

        if(Auth::guard('admin')->attempt(['email' => $request->email , 'password' => $request->password],$request->remember))
        {
            return redirect()->intended(route('admin-dashboard'));
        }
        else
        {
            return redirect()->back()->withInput($request->only(['email','remember']))->with('getMessageBag','Password is wrong.');
        }
    }

    /*admin logout*/

    public function adminLogout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin-login');
    }


}
