<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WaitingListDeliveryBoyNotify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $deliveryBoy,$pickupRequest;
    public function __construct($deliveryBoy,$pickupRequest)
    {
        $this->deliveryBoy=$deliveryBoy;
        $this->pickupRequest=$pickupRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("New Delivery Order")
            ->markdown('emails.delivary-boy.waiting-list')
            ->with('deliveryBoy',$this->deliveryBoy)
            ->with('pickupRequest',$this->pickupRequest);
    }
}
