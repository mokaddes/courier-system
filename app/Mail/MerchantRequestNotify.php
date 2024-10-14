<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MerchantRequestNotify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $merchant;
    public function __construct($merchant)
    {
        $this->merchant = $merchant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $setting = Setting::first();

        return $this->view('emails.admin.merchant-request-notify')
            ->with('setting', $setting)
            ->with('merchant_request', $this->merchant);
    }
}
