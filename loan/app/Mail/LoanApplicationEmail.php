<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoanApplicationEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $applicationData;

    /**
     * Create a new message instance.
     */
    public function __construct(array $applicationData)
    {
        $this->applicationData = $applicationData;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = 'Loan Application ';
        if (isset($this->applicationData['status'])) {
            $status = ucfirst($this->applicationData['status']);
            $subject .= $status;
        } else {
            $subject .= 'Received';
        }

        return new Envelope(
            subject: $subject . ' - ' . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.emails.loan_application',
            with: $this->applicationData
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
