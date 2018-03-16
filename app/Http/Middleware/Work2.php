<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Work2
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


       /* if(Auth::user()->name == null && Auth::user()->userDetail->country_id == null && Auth::user()->userDetail->state_id == null && Auth::user()->userDetail->city_id !== null && Auth::user()->mobile_number == null)
    {

            return redirect()->to(route("profile.edit"));
        }*/

        if(Auth::user()->user_type == 'work_architecture_firm_companies' OR Auth::user()->user_type == 'work_architecture_organizations' OR Auth::user()->user_type == 'work_architecture_college')
        {

            return $next($request);

        }

         return redirect()->to(route('home'));





    }
}
