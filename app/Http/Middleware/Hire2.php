<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Hire2
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
        /*work_individual*/
        if(Auth::user()->user_type == 'real_estate_firm_companies' || Auth::user()->user_type == 'hire_organization')
        {


            return $next($request);

        }



        return redirect()->to(route('home'));
    }
}
