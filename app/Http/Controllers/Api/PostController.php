<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Post::query();

            if ($request->category) {
                $query->where('category', $request->category);
            }
            if ($request->published) {
                $query->where('is_published', true);
            }

            $posts = $query->orderBy('published_at', 'desc')
                ->paginate($request->per_page ?? 12);

            return response()->json([
                'data' => PostResource::collection($posts),
                'meta' => [
                    'current_page' => $posts->currentPage(),
                    'last_page' => $posts->lastPage(),
                    'per_page' => $posts->perPage(),
                    'total' => $posts->total(),
                ],
            ]);
        } catch (\Throwable $e) {
            Log::error('PostController@index: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du chargement des articles.'], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $post = Post::findOrFail($id);
            return response()->json(new PostResource($post));
        } catch (\Throwable $e) {
            Log::error('PostController@show: ' . $e->getMessage());
            return response()->json(['message' => 'Article introuvable.'], 404);
        }
    }

    public function showBySlug(string $slug): JsonResponse
    {
        try {
            $post = Post::where('slug', $slug)->firstOrFail();
            return response()->json(new PostResource($post));
        } catch (\Throwable $e) {
            Log::error('PostController@showBySlug: ' . $e->getMessage());
            return response()->json(['message' => 'Article introuvable.'], 404);
        }
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        try {
            $post = Post::create($request->validated());
            return response()->json(new PostResource($post), 201);
        } catch (\Throwable $e) {
            Log::error('PostController@store: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la creation de l\'article.'], 500);
        }
    }

    public function update(UpdatePostRequest $request, string $id): JsonResponse
    {
        try {
            $post = Post::findOrFail($id);
            $post->update($request->validated());
            return response()->json(new PostResource($post->fresh()));
        } catch (\Throwable $e) {
            Log::error('PostController@update: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise a jour de l\'article.'], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return response()->json(null, 204);
        } catch (\Throwable $e) {
            Log::error('PostController@destroy: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la suppression de l\'article.'], 500);
        }
    }
}
