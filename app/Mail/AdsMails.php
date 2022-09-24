<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdsMails extends Mailable
{
    use Queueable, SerializesModels;

    public $mData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mData)
    {
        $this->mData = $mData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail from Ads Management ')
        ->view('emails.adsMail');
    }
}
