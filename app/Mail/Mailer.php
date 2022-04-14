<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $body;
    public $sub;

    public function __construct($e_sub , $e_body)
    {
        //
        $this->body=$e_body;
        $this->sub=$e_sub;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome TO Hospital !')->view('email.template')->with('body',$this->body)->with('sub',$this->sub);
    }
}
