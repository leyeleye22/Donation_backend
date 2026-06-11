<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Mail\PostPublishedMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendPostPublishedNotification
{
    public function handle(PostPublished $event): void
    {
        try {
            $subscribers = NewsletterSubscriber::where('is_active', true)->get();
            if ($subscribers->isEmpty()) return;

            $post = $event->post;
            $frontendUrl = config('services.frontend.url');

            foreach ($subscribers as $subscriber) {
                try {
                    Mail::to($subscriber->email)
                        ->send(new PostPublishedMail($post, $subscriber->name, $frontendUrl));
                } catch (\Throwable $e) {
                    Log::error("SendPostPublishedNotification: echec envoi a {$subscriber->email}: " . $e->getMessage());
                }
            }
        } catch (\Throwable $e) {
            Log::error('SendPostPublishedNotification@handle: ' . $e->getMessage());
        }
    }
}
