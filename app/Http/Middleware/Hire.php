<?php

namespace App\Http\Middleware;

use Closure;

class Hire
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
        if(Auth::user()->user_type == 'hire_individual')
        {


            return $next($request);

        }



        return redirect()->to(route('home'));
    }
}
