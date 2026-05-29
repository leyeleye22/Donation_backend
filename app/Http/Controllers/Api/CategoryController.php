<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Category::query();
            if ($request->type) {
                $query->where('type', $request->type);
            }
            $categories = $query->orderBy('created_at', 'desc')
                ->paginate($request->per_page ?? 50);
            return response()->json([
                'data' => $categories->items(),
                'meta' => [
                    'current_page' => $categories->currentPage(),
                    'last_page' => $categories->lastPage(),
                    'per_page' => $categories->perPage(),
                    'total' => $categories->total(),
                ],
            ]);
        } catch (\Throwable $e) {
            Log::error('CategoryController@index: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du chargement des categories.'], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $category = Category::findOrFail($id);
            return response()->json($category);
        } catch (\Throwable $e) {
            Log::error('CategoryController@show: ' . $e->getMessage());
            return response()->json(['message' => 'Categorie introuvable.'], 404);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'slug' => 'required|string|unique:categories,slug',
                'name' => 'required|array',
                'description' => 'nullable|array',
                'type' => 'required|string|max:50',
            ]);
            $category = Category::create($validated);
            return response()->json($category, 201);
        } catch (\Throwable $e) {
            Log::error('CategoryController@store: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la creation de la categorie.'], 500);
        }
    }

    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $category = Category::findOrFail($id);
            $validated = $request->validate([
                'slug' => 'sometimes|string|unique:categories,slug,' . $id,
                'name' => 'sometimes|array',
                'description' => 'nullable|array',
                'type' => 'sometimes|string|max:50',
            ]);
            $category->update($validated);
            return response()->json($category->fresh());
        } catch (\Throwable $e) {
            Log::error('CategoryController@update: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise a jour de la categorie.'], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json(null, 204);
        } catch (\Throwable $e) {
            Log::error('CategoryController@destroy: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la suppression de la categorie.'], 500);
        }
    }
}
