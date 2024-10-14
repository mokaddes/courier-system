<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderDeliveredNotifyAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $pickup;
    public function __construct($pickup)
    {
        $this->pickup=$pickup;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): OrderDeliveredNotifyAdmin
    {
        return $this->subject('Order has been delivered')
            ->markdown('emails.delivary-boy.order-delivered-admin')
            ->with('pickup',$this->pickup)
            ;
    }
}
