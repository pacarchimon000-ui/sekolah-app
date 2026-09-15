<?php

namespace App\Mail;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Report $report)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Laporan Berhasil Dikirim',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.report-submitted',
            with: [
                'report' => $this->report,
            ],
        );
    }
}
