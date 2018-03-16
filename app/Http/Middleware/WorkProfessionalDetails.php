<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class WorkProfessionalDetails
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*Auth::user()->usersEducationDetails->first() != null && Auth::user()->usersEducationDetails->first()->course  != null && Auth::user()->usersEducationDetails->first()->college_university  != null && Auth::user()->usersEducationDetails->first()->year_of_admission   != null && Auth::user()->usersEducationDetails->first()->year_of_graduation != null*/




        if(Auth::user()->usersEducationDetails->first() != null && Auth::user()->usersEducationDetails->first()->course  != null && Auth::user()->usersEducationDetails->first()->college_university  != null && Auth::user()->usersEducationDetails->first()->year_of_admission   != null && Auth::user()->usersEducationDetails->first()->year_of_graduation != null)
        {
            return $next($request);
        }
        else
        {
            return redirect()->to(route("profile.edit"));
        }

        if(Auth::user()->first_name !== null && Auth::user()->last_name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->userDetail->gender !== null && Auth::user()->mobile_number !== null && Auth::user()->usersEducationDetails->first() != null && Auth::user()->usersEducationDetails->first()->course  != null && Auth::user()->usersEducationDetails->first()->college_university  != null && Auth::user()->usersEducationDetails->first()->year_of_admission   != null && Auth::user()->usersEducationDetails->first()->year_of_graduation != null)
        {
            User::where('id', Auth::id())->update([
                'profile_flag' => 'y'
            ]);
        }

    }
}
