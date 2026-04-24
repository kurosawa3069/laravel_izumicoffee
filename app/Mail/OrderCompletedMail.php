<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class OrderCompletedMail extends Mailable
{
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('ご注文ありがとうございます')
            ->view('emails.order_completed');
    }
}