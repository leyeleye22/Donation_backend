<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateNavigationOrderRequest;
use App\Http\Resources\NavItemResource;
use App\Models\NavItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NavigationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $query = NavItem::query();
            if (!$request->user() || !$request->boolean('all')) {
                $query->where('is_active', true);
            }
            $items = $query->orderBy('sort_order')->get();
            return response()->json(NavItemResource::collection($items));
        } catch (\Throwable $e) {
            Log::error('NavigationController@index: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du chargement de la navigation.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'label' => 'required|array',
                'href' => 'required|string',
                'is_active' => 'boolean',
                'sort_order' => 'integer|nullable',
            ]);

            $maxOrder = NavItem::max('sort_order') ?? 0;
            $validated['sort_order'] = $validated['sort_order'] ?? $maxOrder + 1;
            $validated['is_active'] = $validated['is_active'] ?? true;

            $item = NavItem::create($validated);
            return response()->json(new NavItemResource($item), 201);
        } catch (\Throwable $e) {
            Log::error('NavigationController@store: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la creation du lien.'], 500);
        }
    }

    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $item = NavItem::findOrFail($id);
            $validated = $request->validate([
                'label' => 'sometimes|array',
                'href' => 'sometimes|string',
                'is_active' => 'sometimes|boolean',
                'sort_order' => 'sometimes|integer',
            ]);
            $item->update($validated);
            return response()->json(new NavItemResource($item->fresh()));
        } catch (\Throwable $e) {
            Log::error('NavigationController@update: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise a jour du lien.'], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $item = NavItem::findOrFail($id);
            $item->delete();
            return response()->json(null, 204);
        } catch (\Throwable $e) {
            Log::error('NavigationController@destroy: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la suppression du lien.'], 500);
        }
    }

    public function updateOrder(UpdateNavigationOrderRequest $request): JsonResponse
    {
        try {
            foreach ($request->input('items') as $item) {
                NavItem::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
            }
            return response()->json(['message' => 'Ordre mis à jour.']);
        } catch (\Throwable $e) {
            Log::error('NavigationController@updateOrder: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise à jour de l\'ordre.'], 500);
        }
    }
}
