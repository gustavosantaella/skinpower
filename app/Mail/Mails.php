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
    public $viewMail;
    public function __construct($subject,$id=null,$datos=null,$viewMail)
    {
        $this->subject = $subject;
        $this->id = $id;
        $this->datos = $datos;
        $this->viewMail = $viewMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('mails.confirmMail')->with('id',$this->id)->with('datos',$this->datos);
        return $this->view("mails.$this->viewMail");
    }

  
}
