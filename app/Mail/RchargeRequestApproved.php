<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RchargeRequestApproved extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public object $merchant;
    public function __construct($merchant)
    {
        $this->merchant=$merchant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Recharge Request Approved')
            ->view('emails.admin.recharge-request-approved')
            ->with('marchant',$this->merchant);
    }
}
