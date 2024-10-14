<?php

namespace App\Mail;

use App\Models\PickupRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MerchantPickUpRequestNotify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $pickupRequest, $paymentStatus;
    public function __construct($pickupRequest,$paymentStatus)
    {
        $this->pickupRequest=$pickupRequest;
        $this->paymentStatus=$paymentStatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pickupRequest=PickupRequest::with(['hasMerchant','city','hasPickupState','hasPriceGroup'])->find($this->pickupRequest->id);

        return $this->subject('New Merchant Pickup Request Order')
            ->markdown('emails.merchant.pickup-request-notify')
            ->with('pickupRequest',$pickupRequest)
            ->with('paymentStatus',$this->paymentStatus);
    }
}
