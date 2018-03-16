<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class HireEmployeeDetails
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
        if(Auth::user()->name !== null && Auth::user()->userDetail->country_id !== null && Auth::user()->userDetail->state_id !== null && Auth::user()->userDetail->city_id !== null && Auth::user()->mobile_number !== null )
        {
            return $next($request);
        }
        else{
            return redirect()->to(route("profile.edit"));
        }
    }
}
