<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $admin,$otp;
    public function __construct($admin,$otp)
    {
        $this->admin=$admin;
        $this->otp=$otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Password Reset Otp')->markdown('mail.reset-password-mail')->with('admin',$this->admin)->with('otp',$this->otp);
    }
}
