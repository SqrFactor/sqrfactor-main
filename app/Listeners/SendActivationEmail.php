<?php

namespace App\Listeners;


use App\Mail\SendActivationToken;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendActivationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle($event)
    {

        //send email only and only if we have email of the use
        if ($event->user->email != null){
            Mail::to($event->user)->send(new SendActivationToken($event->user->activationToken));
        }
    }
}
