<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateNavigationOrderRequest;
use App\Http\Resources\NavItemResource;
use App\Models\NavItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class NavigationController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $items = NavItem::where('is_active', true)->orderBy('sort_order')->get();
            return response()->json(NavItemResource::collection($items));
        } catch (\Throwable $e) {
            Log::error('NavigationController@index: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du chargement de la navigation.'], 500);
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
