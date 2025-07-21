<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use App\Models\Solicitud;

class Bienvenido extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Solicitud */
    public Solicitud $solicitud;

    /**
     * Create a new message instance.
     *
     * @param Solicitud $solicitud
     */
    public function __construct(Solicitud $solicitud)
    {
        $this->solicitud = $solicitud;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('8123110037@utchetumal.edu.mx', 'Angel Uitzil'),
            subject: 'Bienvenido al CRM Universidad',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'email.bienvenido', // la plantilla Markdown
            with: [
                'nombre'  => $this->solicitud->nombre,
                'carrera' => $this->solicitud->carrera,
            ],
        );
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
