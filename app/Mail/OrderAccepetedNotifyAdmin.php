<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderAccepetedNotifyAdmin extends Mailable
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
        return $this->subject("Delivery order has benn accepted")->markdown('emails.delivary-boy.order-accceped-admin')
            ->with('deliveryBoy',$this->deliveryBoy)
            ->with('pickupRequest',$this->pickupRequest);
    }
}
