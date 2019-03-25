<?php

namespace App\Mail;

use App\Devi;
use App\Suscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Command extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $suscriber,$devi;
    public function __construct(Suscriber $suscriber, Devi $devi)
    {
        $this->suscriber=$suscriber;
        $this->devi=$devi;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.command')->subject('Confirmation de commande')->with(
            [
                'suscriber' => $this->suscriber,
                'devi' => $this->devi,
            ]
        );
    }
}
