<?php

namespace App\Providers;


use App\Events\UserRegistered;
use App\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Mail;
use App\Mail\SendActivationToken;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);

        User::created(function($user){

            $token = $user->activationToken()->create([
                'token' => str_random(128),
            ]);

            // mail

            event(new UserRegistered($user));

            /* Mail::to($user)->send(new SendActivationToken($token));*/

        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
