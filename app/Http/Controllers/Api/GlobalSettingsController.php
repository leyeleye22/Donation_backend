<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateGlobalSettingsRequest;
use App\Http\Requests\UpdateVisibilityRequest;
use App\Http\Resources\GlobalSettingsResource;
use App\Models\GlobalSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class GlobalSettingsController extends Controller
{
    public function show(): JsonResponse
    {
        try {
            return response()->json(GlobalSettingsResource::make(GlobalSetting::singleton()));
        } catch (\Throwable $e) {
            Log::error('GlobalSettingsController@show: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du chargement des paramètres.'], 500);
        }
    }

    public function update(UpdateGlobalSettingsRequest $request): JsonResponse
    {
        try {
            $settings = GlobalSetting::singleton();
            $settings->update($request->validated());
            return response()->json(GlobalSettingsResource::make($settings->fresh()));
        } catch (\Throwable $e) {
            Log::error('GlobalSettingsController@update: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise à jour des paramètres.'], 500);
        }
    }

    public function visibility(): JsonResponse
    {
        try {
            $settings = GlobalSetting::singleton();
            return response()->json(['data' => $settings->page_visibility ?? []]);
        } catch (\Throwable $e) {
            Log::error('GlobalSettingsController@visibility: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du chargement de la visibilité.'], 500);
        }
    }

    public function updateVisibility(UpdateVisibilityRequest $request): JsonResponse
    {
        try {
            $settings = GlobalSetting::singleton();
            $settings->update(['page_visibility' => $request->input('page_visibility')]);
            return response()->json(GlobalSettingsResource::make($settings->fresh()));
        } catch (\Throwable $e) {
            Log::error('GlobalSettingsController@updateVisibility: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise à jour de la visibilité.'], 500);
        }
    }
}
