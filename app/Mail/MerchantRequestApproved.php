<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MerchantRequestApproved extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $merchant_request, $password;
    public function __construct($merchant_request, $password)
    {
        $this->merchant_request = $merchant_request;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $setting = Setting::first();

        return $this->subject('Merchant Request Approved')->view('emails.merchant.marchant-request-approved')
            ->with('merchant_request', $this->merchant_request)
            ->with('setting', $setting)
            ->with('password', $this->password);
    }
}
