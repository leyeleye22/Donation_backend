<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactMessageController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'nullable|string|max:255',
                'message' => 'required|string',
            ]);

            ContactMessage::create([
                'name' => $validated['first_name'] . ' ' . $validated['last_name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message'],
            ]);

            return response()->json(['message' => 'Message envoye avec succes.'], 201);
        } catch (\Throwable $e) {
            Log::error('ContactMessageController@store: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de l\'envoi du message.'], 500);
        }
    }

    public function index(): JsonResponse
    {
        try {
            $messages = ContactMessage::orderByDesc('created_at')->get();

            return response()->json([
                'data' => $messages->map(fn (ContactMessage $message) => [
                    'id' => $message->id,
                    'name' => $message->name,
                    'email' => $message->email,
                    'subject' => $message->subject,
                    'message' => $message->message,
                    'is_read' => (bool) $message->is_read,
                    'created_at' => $message->created_at?->toIso8601String(),
                ]),
            ]);
        } catch (\Throwable $e) {
            Log::error('ContactMessageController@index: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du chargement des messages.'], 500);
        }
    }

    public function markAsRead(string $id): JsonResponse
    {
        try {
            $message = ContactMessage::findOrFail($id);
            $message->update(['is_read' => true, 'read_at' => now()]);

            return response()->json(['message' => 'Message marque comme lu.']);
        } catch (\Throwable $e) {
            Log::error('ContactMessageController@markAsRead: ' . $e->getMessage());
            return response()->json(['message' => 'Message introuvable.'], 404);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $message = ContactMessage::findOrFail($id);
            $message->delete();

            return response()->json(null, 204);
        } catch (\Throwable $e) {
            Log::error('ContactMessageController@destroy: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la suppression.'], 500);
        }
    }
}
