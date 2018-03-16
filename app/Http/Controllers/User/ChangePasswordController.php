<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function changePasswordAdd()
    {
        return view('users.change-password');
    }

    public function changePasswordSave(Request $request)
    {






        $this->validate($request,[
           'old_password' => 'required',
            'new_password' => 'required|confirmed|string|min:6',

        ]);



        if (Hash::check($request->old_password,$request->user()->password)) {
            // The passwords match...

            $request->user()->update(['password' =>bcrypt($request->new_password)]);

            return redirect()->back()->with('success','Password has been changed successfully.');

        }
        else
        {
            return redirect()->back()->with('old_password_wrong','Old password is wrong.');
        }


    }
}
