<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NovoMedicoRegistrado extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $medico)
    {
        $this->user = $user;
        $this->medico = $medico;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/revisar/'.$this->medico->token_aprovacao);

        return (new MailMessage)
            ->line('Um novo médico se cadastrou:')
            ->line('Nome: '.$this->user->name)
            ->line('CRM: '.$this->medico->crm)
            ->line('Especialidade: '.$this->medico->especialidade)
            ->action('Revisar Médico', $url)
            ->line('Obrigado pela atenção!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
