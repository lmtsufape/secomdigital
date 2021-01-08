<?php

namespace App\Mail;

use App\Servidor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClippingMail extends Mailable
{
    use Queueable, SerializesModels;

    private $noticias, $comunicados, $agenda, $editais;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($noticias, $comunicados, $agenda, $editais)
    {
        $this->noticias = $noticias;
        $this->comunicados = $comunicados;
        $this->agenda = $agenda;
        $this->editais = $editais;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $servidores = Servidor::all();
        $emails = [];
        $nomes = [];
        foreach ($servidores as $servi) {
            array_push($emails, $servi->email);
            array_push($nomes, $servi->nome);
        }
        $this->subject('Clipping Portal UFAPE - '.date('d/m/Y', strtotime("-1 week")).' a '.date('d/m/Y'));
        $this->to($emails, $nomes);
        return $this->view('emails.Clipping', [
            'noticias' => $this->noticias,
            'comunicados' => $this->comunicados,
            'agenda' => $this->agenda,
            'editais' => $this->editais
        ]);
    }
}
