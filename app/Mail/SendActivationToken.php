<?php

namespace App\Mail;
use App\ActivationToken;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class SendActivationToken extends Mailable
{
    use Queueable, SerializesModels;
    public  $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ActivationToken $token)
    {
        $this->token = $token;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $content = [
        'title'=> 'Dear '.$this->token->user->fullName().',',
        'body'=> 'Thank you for signing up. This is a verification email to verify your email. Please click the link below :',

        'url_link' => $this->token->token

    ];

        return $this->subject('Account Activation')->markdown('emails.activationUser')->with('content',$content);

    }
}
