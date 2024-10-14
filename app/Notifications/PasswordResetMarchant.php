<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetMarchant extends Notification
{
    use Queueable;

    public $token,$request;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token,$request)
    {
        $this->token = $token;
        $this->request = $request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You are receiving this email because we received a password reset request for your account.') // Here are the lines you can safely override
            ->action('Reset Password', url('password/reset/'. $this->token,['email'=>$this->request->email,'user_type'=>$this->request->broker]))
            ->line('If you did not request a password reset, no further action is required.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
