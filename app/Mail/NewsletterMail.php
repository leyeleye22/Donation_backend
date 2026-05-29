<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $emailSubject;
    public string $emailContent;
    public ?string $subscriberName;

    public function __construct(string $subject, string $content, ?string $subscriberName = null)
    {
        $this->emailSubject = $subject;
        $this->emailContent = $content;
        $this->subscriberName = $subscriberName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->emailSubject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter',
        );
    }
}
