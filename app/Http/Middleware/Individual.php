<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Individual
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
        if(Auth::user()->user_type == 'work_individual')
        {
            return $next($request);
        }
        abort('404');

    }
}
