<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\GlobalSettingsController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\NavigationController;
use App\Http\Controllers\Api\PageContentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

// Routes publiques (aucune authentification requise)
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::get('/posts/slug/{slug}', [PostController::class, 'showBySlug']);
Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/gallery/{id}', [GalleryController::class, 'show']);
Route::get('/navigation', [NavigationController::class, 'index']);
Route::get('/pages/{slug}', [PageContentController::class, 'show']);
Route::get('/settings', [GlobalSettingsController::class, 'show']);
Route::get('/settings/visibility', [GlobalSettingsController::class, 'visibility']);

// Auth publique
Route::post('/login', [AuthController::class, 'login']);
Route::post('/refresh', [AuthController::class, 'refresh']);

// Routes protegees (authentification requise)
Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard/kpi', [DashboardController::class, 'kpi']);

    Route::put('/navigation/order', [NavigationController::class, 'updateOrder']);

    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);

    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);

    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy']);

    Route::post('/media/upload', [MediaController::class, 'upload']);

    Route::put('/pages/{slug}', [PageContentController::class, 'update']);
    Route::get('/pages/{slug}/versions', [PageContentController::class, 'versions']);

    Route::put('/settings', [GlobalSettingsController::class, 'update']);
    Route::put('/settings/visibility', [GlobalSettingsController::class, 'updateVisibility']);
});
