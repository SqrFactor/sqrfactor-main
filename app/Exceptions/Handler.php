<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        /* if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException)
         {
             return response()->view('404', [], 404);
         }

         if ($exception instanceof \InvalidArgumentException) {
             return response()->view('404', [], 404);
         }


         if ($exception instanceof ModelNotFoundException) {

             return response()->view('404', [], 404);
         }*/
        if ($exception instanceof TokenMismatchException) {
            return redirect()->back()->withInput()->with('oops', 'Something went wrong  try again.');
        } else if ($exception instanceof NotFoundHttpException) {
            return redirect()->route('404');
        } else if ($exception instanceof ModelNotFoundException) {
            return redirect()->route('404');
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        /*  return redirect()->guest('/login?active=login');*/

        $guard = array_get($exception->guards(), 0);

        switch ($guard) {
            case 'admin';
                $login = 'admin-login';
                break;

            default:
                $login = 'login';
                break;
        }

        return redirect()->guest(route($login));
    }
}
