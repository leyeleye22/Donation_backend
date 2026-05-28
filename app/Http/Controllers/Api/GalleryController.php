<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Models\GalleryItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $query = GalleryItem::query();

            if ($request->type) {
                $query->where('file_type', $request->type);
            }

            $items = $query->orderBy('created_at', 'desc')->get();

            return response()->json([
                'data' => MediaResource::collection($items),
            ]);
        } catch (\Throwable $e) {
            Log::error('GalleryController@index: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du chargement de la galerie.'], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $item = GalleryItem::findOrFail($id);
            return response()->json(new MediaResource($item));
        } catch (\Throwable $e) {
            Log::error('GalleryController@show: ' . $e->getMessage());
            return response()->json(['message' => 'Media introuvable.'], 404);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $item = GalleryItem::findOrFail($id);
            $item->delete();
            return response()->json(null, 204);
        } catch (\Throwable $e) {
            Log::error('GalleryController@destroy: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la suppression du media.'], 500);
        }
    }
}
