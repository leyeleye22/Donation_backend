<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\GalleryItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function upload(UploadMediaRequest $request): JsonResponse
    {
        try {
            $file = $request->file('file');
            $path = $file->store('media', 'public');
            $mimeType = $file->getMimeType();
            $title = $this->parseTitle($request, $file->getClientOriginalName());

            $data = [
                'file_path' => Storage::url($path),
                'file_type' => str_starts_with($mimeType, 'video/') ? 'video' : 'image',
                'file_size' => $file->getSize(),
                'mime_type' => $mimeType,
                'title' => $title,
                'uploaded_by' => auth()->id(),
            ];
            if ($request->has('categories')) {
                $data['categories'] = $request->input('categories');
            }
            $item = GalleryItem::create($data);

            return response()->json(new MediaResource($item), 201);
        } catch (\Throwable $e) {
            Log::error('MediaController@upload: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du téléchargement du fichier.'], 500);
        }
    }

    private function parseTitle(UploadMediaRequest $request, string $fallback): array
    {
        $title = $request->input('title');
        if (is_string($title)) {
            $decoded = json_decode($title, true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }
        if (is_array($title)) {
            return $title;
        }

        return ['fr' => $fallback];
    }
}
