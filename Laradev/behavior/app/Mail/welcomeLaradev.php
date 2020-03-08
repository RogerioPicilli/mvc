<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class welcomeLaradev extends Mailable implements ShouldQueue    
{
    use Queueable, SerializesModels;

    //Criados por mim para que toda a classe veja os parametros passados no metodo construct
    private $user;
    private $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Seja benvindo à Docs Ti Brasil');
        $this->to($this->user->email, $this->user->name);
        return $this->markdown('mail.welcomeLaradev')->with(['user' => $this->user, 'order' =>$this->order]);
    }
}
