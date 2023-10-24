<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AprovacaoCadastroMedico extends Notification
{
    use Queueable;

    protected $aprovado;

    public function __construct($aprovado)
    {
        $this->aprovado = $aprovado;
    }

    public function toMail($notifiable)
    {
        $status = $this->aprovado ? 'aprovado' : 'negado';
        $actionText = $this->aprovado ? 'Login Médico' : 'Entrar em Contato';
        $actionUrl = $this->aprovado ? route('medico.login') : route('contato');

        return (new MailMessage)
            ->line('Seu cadastro como médico foi ' . $status . '.')
            ->action($actionText, $actionUrl)
            ->line('Obrigado por usar nossa aplicação!');
    }

    // Restante da notificação
}
