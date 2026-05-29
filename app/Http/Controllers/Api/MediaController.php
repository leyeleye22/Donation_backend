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

            $data = [
                'file_path' => Storage::url($path),
                'file_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'title' => $request->input('title', ['fr' => $file->getClientOriginalName()]),
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
}
