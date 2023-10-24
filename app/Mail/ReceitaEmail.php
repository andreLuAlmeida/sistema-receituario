<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReceitaEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $qrcodePath;

    public function __construct($qrcodePath)
    {
        $this->qrcodePath = $qrcodePath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Receita Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return $this->view('emails.receita')
            ->attach($this->qrcodePath, [
                'as' => 'qrcode.png',
                'mime' => 'image/png',
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }


}
