<?php

namespace App\Mail;

use App\Models\ConsultationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConsultationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $consultation;

    public function __construct($consultation)
    {
        $this->consultation = $consultation;
    }

    public function build()
    {

        return $this->subject('New Consultation Request - LondaLoan')
            ->view('emails.received')
            ->with([
                'consultation' => $this->consultation
            ]);
    }
}
