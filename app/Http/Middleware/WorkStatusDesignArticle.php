<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class WorkStatusDesignArticle
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
        if(Auth::user()->type == 'work')
        {
            if(Auth::user()->user_type == 'work_individual')
            {
                return $next($request);
            }
            elseif(Auth::user()->user_type == 'work_architecture_firm_companies' || Auth::user()->user_type == 'work_architecture_organizations' || Auth::user()->user_type == 'work_architecture_college')
            {
                return $next($request);
            }
            else{
                abort('404');
            }

        }


        if (Auth::user()->type == 'hire')
        {
            if(Auth::user()->user_type == 'hire_organization')
            {
                return $next($request);
            }
            else
            {
                abort('404');
            }


        }


    }
}
