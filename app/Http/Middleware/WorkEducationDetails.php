<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class WorkEducationDetails
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




        if(Auth::user()->first_name !== null && Auth::user()->last_name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->userDetail->gender !== null && Auth::user()->mobile_number !== null)
        {

            return $next($request);

        }
        else
        {
            return redirect()->to(route("profile.edit"));


        }

    }
}
