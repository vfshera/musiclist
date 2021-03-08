<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForwardEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $msg;
    public $name;
    public $email;
    public $subject;

    public function __construct($data)
    {

        $this->msg = $data->message;
        $this->name = $data->name;
        $this->subject = $data->subject;
        $this->email = $data->email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email, 'Contact Mail From '.$this->name)->subject($this->subject)->view('mails.contact.forward');

    }
}
