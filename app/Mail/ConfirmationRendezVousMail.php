<?php

namespace App\Mail;

use App\Models\RendezVous;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmationRendezVousMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public RendezVous $rendezVous
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de votre rendez-vous — Cabinet Médical',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmation-rendezvous',
        );
    }
}
