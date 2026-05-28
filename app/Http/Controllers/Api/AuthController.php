<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only('email', 'password');

            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Identifiants invalides.',
                ], 401);
            }

            $user = auth()->user();

            return response()->json([
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => config('jwt.ttl', 60) * 60,
                'user' => new \App\Http\Resources\UserResource($user),
            ]);
        } catch (JWTException $e) {
            Log::error('Auth login JWT error: ' . $e->getMessage());

            return response()->json([
                'message' => 'Impossible de creer le token.',
            ], 500);
        } catch (\Throwable $e) {
            Log::error('Auth login error: ' . $e->getMessage());

            return response()->json([
                'message' => 'Erreur lors de la connexion.',
            ], 500);
        }
    }

    public function me(): JsonResponse
    {
        try {
            return response()->json(new \App\Http\Resources\UserResource(auth()->user()));
        } catch (\Throwable $e) {
            Log::error('Auth me error: ' . $e->getMessage());

            return response()->json(['message' => 'Impossible de recuperer l\'utilisateur.'], 500);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(['message' => 'Deconnexion reussie.']);
        } catch (JWTException $e) {
            Log::error('Auth logout JWT error: ' . $e->getMessage());

            return response()->json(['message' => 'Impossible de deconnecter.'], 500);
        } catch (\Throwable $e) {
            Log::error('Auth logout error: ' . $e->getMessage());

            return response()->json(['message' => 'Erreur lors de la deconnexion.'], 500);
        }
    }

    public function refresh(): JsonResponse
    {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());

            return response()->json([
                'token' => $newToken,
                'token_type' => 'bearer',
                'expires_in' => config('jwt.ttl', 60) * 60,
            ]);
        } catch (JWTException $e) {
            Log::error('Auth refresh JWT error: ' . $e->getMessage());

            return response()->json(['message' => 'Impossible de rafraichir le token.'], 500);
        } catch (\Throwable $e) {
            Log::error('Auth refresh error: ' . $e->getMessage());

            return response()->json(['message' => 'Erreur lors du rafraichissement.'], 500);
        }
    }
}
