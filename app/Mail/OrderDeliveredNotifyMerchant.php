<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderDeliveredNotifyMerchant extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $pickup,$merchant;

    public function __construct($pickup,$merchant)
    {
        $this->pickup = $pickup;
        $this->merchant = $merchant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order has been delivered')->markdown('emails.delivary-boy.order-delivered-merchant')
            ->with('pickup', $this->pickup)
            ->with('merchant', $this->merchant);
    }
}
