<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostPublishedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Post $post;
    public ?string $subscriberName;
    public string $frontendUrl;

    public function __construct(Post $post, ?string $subscriberName, string $frontendUrl)
    {
        $this->post = $post;
        $this->subscriberName = $subscriberName;
        $this->frontendUrl = $frontendUrl;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Nouvel article: {$this->post->title}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.post-published',
        );
    }
}
