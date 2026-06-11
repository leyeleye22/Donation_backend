<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Project::query();

            if ($request->theme) {
                $query->where('theme', $request->theme);
            }
            if ($request->status) {
                $query->where('status', $request->status);
            }

            $projects = $query->orderBy('created_at', 'desc')
                ->paginate($request->per_page ?? 12);

            return response()->json([
                'data' => ProjectResource::collection($projects),
                'meta' => [
                    'current_page' => $projects->currentPage(),
                    'last_page' => $projects->lastPage(),
                    'per_page' => $projects->perPage(),
                    'total' => $projects->total(),
                ],
            ]);
        } catch (\Throwable $e) {
            Log::error('ProjectController@index: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du chargement des projets.'], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $project = Project::findOrFail($id);
            return response()->json(new ProjectResource($project));
        } catch (\Throwable $e) {
            Log::error('ProjectController@show: ' . $e->getMessage());
            return response()->json(['message' => 'Projet introuvable.'], 404);
        }
    }

    public function showBySlug(string $slug): JsonResponse
    {
        try {
            $project = Project::where('slug', $slug)->firstOrFail();
            return response()->json(new ProjectResource($project));
        } catch (\Throwable $e) {
            Log::error('ProjectController@showBySlug: ' . $e->getMessage());
            return response()->json(['message' => 'Projet introuvable.'], 404);
        }
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        try {
            $project = Project::create($request->validated());
            return response()->json(new ProjectResource($project), 201);
        } catch (\Throwable $e) {
            Log::error('ProjectController@store: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la creation du projet.'], 500);
        }
    }

    public function update(UpdateProjectRequest $request, string $id): JsonResponse
    {
        try {
            $project = Project::findOrFail($id);
            $project->update($request->validated());
            return response()->json(new ProjectResource($project->fresh()));
        } catch (\Throwable $e) {
            Log::error('ProjectController@update: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise a jour du projet.'], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $project = Project::findOrFail($id);
            $project->delete();
            return response()->json(null, 204);
        } catch (\Throwable $e) {
            Log::error('ProjectController@destroy: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la suppression du projet.'], 500);
        }
    }
}
