<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MedicoNegadoNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
        $contactUrl = route('contact.index'); // Defina a rota correta para a tela de contato

        return (new MailMessage)
            ->line('Sua requisição de usuário médico foi negada.')
            ->line('Se você deseja contestar esta decisão ou obter mais informações, entre em contato conosco.')
            ->action('Entrar em Contato', $contactUrl)
            ->line('Obrigado por usar nosso serviço.');
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
