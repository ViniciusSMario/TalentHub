<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailTestePratico extends Mailable
{
    use Queueable, SerializesModels;

    public string $nome_candidato;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome_candidato)
    {
        $this->nome_candidato = $nome_candidato;
        $this->subject = "Próxima fase: Teste Prático!";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.candidato-teste-pratico');
    }
}
