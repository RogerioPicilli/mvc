<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;

class emailWelcome implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //Criados por mim para que toda a classe veja os parametros passados no metodo construct
    public $tries = 3;
    private $user;
    private $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    public function handle()
    {
        Illuminate\Support\Facades\Mail::send(new \App\Mail\welcomeLaradev($this->user, $this->order));
    }
}
