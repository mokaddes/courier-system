<?php

namespace App\Mail;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RchargeRequestNotify extends Mailable
{
    use Queueable, SerializesModels;
    public $recharge_request;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recharge_request)
    {
        $this->recharge_request=$recharge_request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $marchant=Admin::find($this->recharge_request->merchant_id);
        return $this->subject('New Recharge Request')->view('emails.admin.recharge-request')->with('marchant',$marchant)->with('recharge_request',$this->recharge_request);
    }
}
