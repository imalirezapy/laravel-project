<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FactorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $factor;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($factor)
    {
        $this->factor = $factor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.factor')->subject('فاکتور خرید');
    }
}
