<?php

// app/Mail/LoanApplicationSubmitted.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LoanApplicationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $logoData;

    public function __construct($data)
    {
        $this->data = $data;
        $this->logoData = $this->getLogoAsBase64();
    }

    private function getLogoAsBase64()
    {
        try {
            $logoPath = public_path('assets/logos/londa.jpg');

            if (file_exists($logoPath)) {
                $imageData = file_get_contents($logoPath);
                $base64 = base64_encode($imageData);
                $mimeType = mime_content_type($logoPath);

                return "data:{$mimeType};base64,{$base64}";
            }

            // Fallback: Return null if logo doesn't exist
            return null;
        } catch (\Exception $e) {
            Log::error('Failed to load logo: ' . $e->getMessage());
            return null;
        }
    }

    public function build()
    {
        return $this->subject('New Loan Application - LondaLoan')
            ->view('emails.loan-application')
            ->with([
                'data' => $this->data,
                'logoData' => $this->logoData
            ]);
    }
}
