<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\UserCompetitionDesignSubmition;

class LikeNoti_DesignSubmission extends Notification
{
    use Queueable;
    public $designSubmissionLike;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(UserCompetitionDesignSubmition $designSubmissionLike)
    {
        //
        $this->designSubmissionLike = $designSubmissionLike;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'designSubmissionLike' => $this->designSubmissionLike
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
