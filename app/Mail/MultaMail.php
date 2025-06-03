<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MultaMail extends Mailable
{
    use Queueable, SerializesModels;
    public $prestamo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($prestamo)
    {
        $this->prestamo = $prestamo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Tienes una multa pendiente.')
            ->view('multas.EmailMulta');
    }
}
