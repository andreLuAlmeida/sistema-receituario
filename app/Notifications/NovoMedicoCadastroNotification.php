<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Medico;

class NovoMedicoCadastroNotification extends Notification
{
    use Queueable;

    protected $medico;
    protected $medicoId;

    /**
     * Create a new notification instance.
     */
    public function __construct(Medico $medico, $medicoId)
    {
        $this->medico = $medico;
        $this->medicoId = $medicoId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Um novo cadastro de médico está pendente de aprovação.')
            ->line('Nome: ' . $this->medico->name)
            ->line('E-mail: ' . $this->medico->email)
            ->line('Especialidade: ' . $this->medico->especialidade)
            ->action('Visualizar Médico', route('pedido.registro', $this->medicoId))
            ->line('Obrigado por usar nossa aplicação!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
