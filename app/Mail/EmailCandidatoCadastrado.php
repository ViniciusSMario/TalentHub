<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailCandidatoCadastrado extends Mailable
{
    use Queueable, SerializesModels;

    public string $nome_candidato;
    public string $nome_vaga;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome_candidato, $nome_vaga)
    {
        $this->nome_candidato = $nome_candidato;
        $this->nome_vaga = $nome_vaga;
        $this->subject = "Candidatura enviada com sucesso!";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.candidato-cadastrado');
    }
}
