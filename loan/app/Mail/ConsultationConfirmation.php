<?php

namespace App\Mail;

use App\Models\ConsultationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConsultationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $consultation;

    /**
     * Create a new message instance.
     */
    public function __construct(ConsultationRequest $consultation)
    {
        $this->consultation = $consultation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Consultation Confirmation - ' . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.confirmation',
            with: [
                'consultation' => $this->consultation
            ]
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
