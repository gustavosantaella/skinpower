<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mails extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public $subject;
    public $id;
    public $datos;
    public function __construct(string $subject,$id=null,array $datos=null)
    {
        $this->subject = $subject;
        $this->id = $id;
        $this->datos = $datos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.confirmMail')->with('id',$this->id)->with('datos',$this->datos);
    }
}
