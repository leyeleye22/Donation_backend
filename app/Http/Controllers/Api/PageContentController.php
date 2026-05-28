<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePageContentRequest;
use App\Http\Resources\PageContentResource;
use App\Models\PageContent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PageContentController extends Controller
{
    public function show(string $slug): JsonResponse
    {
        try {
            $page = PageContent::where('page_slug', $slug)->firstOrFail();
            return response()->json(new PageContentResource($page));
        } catch (\Throwable $e) {
            Log::error('PageContentController@show: ' . $e->getMessage());
            return response()->json(['message' => 'Page introuvable.'], 404);
        }
    }

    public function update(UpdatePageContentRequest $request, string $slug): JsonResponse
    {
        try {
            $page = PageContent::where('page_slug', $slug)->firstOrFail();
            $page->update([
                'content' => $request->input('content'),
                'published_by' => auth()->id(),
                'published_at' => now(),
            ]);
            return response()->json(new PageContentResource($page->fresh()));
        } catch (\Throwable $e) {
            Log::error('PageContentController@update: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise a jour de la page.'], 500);
        }
    }

    public function versions(string $slug): JsonResponse
    {
        try {
            $page = PageContent::where('page_slug', $slug)->firstOrFail();
            return response()->json(['data' => $page->versions()->orderBy('created_at', 'desc')->get()]);
        } catch (\Throwable $e) {
            Log::error('PageContentController@versions: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du chargement des versions.'], 500);
        }
    }
}
