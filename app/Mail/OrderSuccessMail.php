<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class OrderSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderinfo;

    /**
     * Create a new message instance.
     */
    public function __construct($orderinfo)
    {
        $this->orderinfo = $orderinfo;
    }

    /**
     * Get the message envelope.
     */
    public function build() {
        return $this->view('emails.order_success')->subject('Your Order was successful!');
    }
}
