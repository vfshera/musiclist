<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsLetterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $info;



    public function __construct($newsdata)
    {
       $this->info = $newsdata;
    }


    public function build()
    {
        return $this->from(env('SUPPORT_MAIL_ADDRESS'), env('APP_NAME').' Support Team')->subject('Newsletter Subscription!')->view('mails.newsletter.subscribed');
    }
}
