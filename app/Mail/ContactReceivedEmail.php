<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReceivedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $receiverName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($receiverName)
    {
       $this->receiverName = $receiverName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME').' Support Team')->subject('Message Delivered!')->view('mails.contact.received');
    }
}
