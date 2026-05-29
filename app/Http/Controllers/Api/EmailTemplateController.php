<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterMail;
use App\Models\EmailTemplate;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailTemplateController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $templates = EmailTemplate::orderBy('created_at', 'desc')->get();
            return response()->json(['data' => $templates]);
        } catch (\Throwable $e) {
            Log::error('EmailTemplateController@index: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du chargement des templates.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'subject' => 'required|string|max:255',
                'content' => 'required|string',
            ]);
            $template = EmailTemplate::create($validated);
            return response()->json(['data' => $template], 201);
        } catch (\Throwable $e) {
            Log::error('EmailTemplateController@store: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la creation du template.'], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $template = EmailTemplate::findOrFail($id);
            return response()->json(['data' => $template]);
        } catch (\Throwable $e) {
            Log::error('EmailTemplateController@show: ' . $e->getMessage());
            return response()->json(['message' => 'Template introuvable.'], 404);
        }
    }

    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $template = EmailTemplate::findOrFail($id);
            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'subject' => 'sometimes|string|max:255',
                'content' => 'sometimes|string',
            ]);
            $template->update($validated);
            return response()->json(['data' => $template->fresh()]);
        } catch (\Throwable $e) {
            Log::error('EmailTemplateController@update: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise a jour du template.'], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $template = EmailTemplate::findOrFail($id);
            $template->delete();
            return response()->json(null, 204);
        } catch (\Throwable $e) {
            Log::error('EmailTemplateController@destroy: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la suppression du template.'], 500);
        }
    }

    public function send(Request $request, string $id): JsonResponse
    {
        try {
            $template = EmailTemplate::findOrFail($id);
            $subject = $request->subject ?? $template->subject;
            $content = $request->content ?? $template->content;

            $subscribers = NewsletterSubscriber::where('is_active', true)->get();

            if ($subscribers->isEmpty()) {
                return response()->json(['message' => 'Aucun abonne actif.'], 400);
            }

            $sent = 0;
            foreach ($subscribers as $subscriber) {
                try {
                    Mail::to($subscriber->email)
                        ->send(new NewsletterMail($subject, $content, $subscriber->name));
                    $sent++;
                } catch (\Throwable $e) {
                    Log::error("Envoi echoue a {$subscriber->email}: " . $e->getMessage());
                }
            }

            return response()->json([
                'message' => "Email envoye a {$sent} abonne(s).",
                'sent' => $sent,
                'total' => $subscribers->count(),
            ]);
        } catch (\Throwable $e) {
            Log::error('EmailTemplateController@send: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de l\'envoi.'], 500);
        }
    }
}
