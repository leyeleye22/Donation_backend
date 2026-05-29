<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $subscribers = NewsletterSubscriber::orderBy('created_at', 'desc')->get();
            return response()->json([
                'data' => $subscribers,
                'total' => $subscribers->count(),
                'active' => $subscribers->where('is_active', true)->count(),
            ]);
        } catch (\Throwable $e) {
            Log::error('NewsletterController@index: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du chargement des abonnes.'], 500);
        }
    }

    public function subscribe(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email|max:255',
                'name' => 'nullable|string|max:255',
            ]);

            $existing = NewsletterSubscriber::where('email', $validated['email'])->first();
            if ($existing) {
                if (!$existing->is_active) {
                    $existing->update(['is_active' => true, 'subscribed_at' => now()]);
                    return response()->json(['message' => 'Abonnement reactive avec succes.'], 200);
                }
                return response()->json(['message' => 'Cet email est deja abonne.'], 200);
            }

            NewsletterSubscriber::create([
                'email' => $validated['email'],
                'name' => $validated['name'] ?? null,
                'is_active' => true,
                'subscribed_at' => now(),
            ]);

            return response()->json(['message' => 'Inscription reussie. Merci !'], 201);
        } catch (\Throwable $e) {
            Log::error('NewsletterController@subscribe: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de l\'inscription.'], 500);
        }
    }

    public function unsubscribe(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate(['email' => 'required|email']);

            $subscriber = NewsletterSubscriber::where('email', $validated['email'])->first();
            if (!$subscriber) {
                return response()->json(['message' => 'Email non trouve.'], 404);
            }

            $subscriber->update(['is_active' => false]);
            return response()->json(['message' => 'Desabonnement effectue avec succes.']);
        } catch (\Throwable $e) {
            Log::error('NewsletterController@unsubscribe: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du desabonnement.'], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $subscriber = NewsletterSubscriber::findOrFail($id);
            $subscriber->delete();
            return response()->json(null, 204);
        } catch (\Throwable $e) {
            Log::error('NewsletterController@destroy: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la suppression.'], 500);
        }
    }
}
