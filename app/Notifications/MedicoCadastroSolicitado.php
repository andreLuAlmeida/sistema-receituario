<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MedicoCadastroSolicitado extends Notification
{
    protected $medico;

    public function __construct(Medico $medico)
    {
        $this->medico = $medico;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Você recebeu uma solicitação de cadastro de médico.')
            ->action('Visualizar Solicitação', route('admin.medico.aprovar', ['medico' => $this->medico->id, 'token' => $this->medico->token_aprovacao]))
            ->line('Obrigado por usar nossa aplicação!');
    }
}
