<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPassword extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $user;
    protected $clave;

    public function __construct($user, $clave)
    {
        $this->user = $user;
        $this->clave = $clave;
    }

    public function build()
    {
        return $this->subject('Detalles de ingreso')->view('emails.userPassword')->with(['user' => $this->user, 'clave' => $this->clave]);
    }
}
