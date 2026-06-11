<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactMessageController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\EmailTemplateController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\GlobalSettingsController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\NavigationController;
use App\Http\Controllers\Api\NewsletterController;
use App\Http\Controllers\Api\PageContentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

// Routes publiques (aucune authentification requise)
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/slug/{slug}', [ProjectController::class, 'showBySlug']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);
Route::get('/posts', [PostController::class, 'index'])->middleware('jwt.optional');
Route::get('/posts/slug/{slug}', [PostController::class, 'showBySlug'])->middleware('jwt.optional');
Route::get('/posts/{id}', [PostController::class, 'show'])->middleware('jwt.optional');
Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/gallery/{id}', [GalleryController::class, 'show']);
Route::get('/navigation', [NavigationController::class, 'index']);
Route::get('/pages/{slug}', [PageContentController::class, 'show']);
Route::get('/settings', [GlobalSettingsController::class, 'show']);
Route::get('/settings/visibility', [GlobalSettingsController::class, 'visibility']);
Route::post('/contact', [ContactMessageController::class, 'store'])->middleware('throttle:20,60');

// Newsletter public
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->middleware('throttle:20,60');
Route::post('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->middleware('throttle:20,60');

// Auth publique
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,60');
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('throttle:30,60');

// Routes protegees (authentification requise)
Route::middleware(['auth:api', \App\Http\Middleware\CheckApiPermission::class])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard/kpi', [DashboardController::class, 'kpi']);

    Route::put('/navigation/order', [NavigationController::class, 'updateOrder']);
    Route::post('/navigation', [NavigationController::class, 'store']);
    Route::put('/navigation/{id}', [NavigationController::class, 'update']);
    Route::delete('/navigation/{id}', [NavigationController::class, 'destroy']);

    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);

    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);

    Route::post('/gallery', [GalleryController::class, 'store']);
    Route::put('/gallery/{id}', [GalleryController::class, 'update']);
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    Route::post('/media/upload', [MediaController::class, 'upload']);

    Route::put('/pages/{slug}', [PageContentController::class, 'update']);
    Route::get('/pages/{slug}/versions', [PageContentController::class, 'versions']);

    Route::put('/settings', [GlobalSettingsController::class, 'update']);
    Route::put('/settings/visibility', [GlobalSettingsController::class, 'updateVisibility']);

    // Email templates
    Route::get('/email-templates', [EmailTemplateController::class, 'index']);
    Route::post('/email-templates', [EmailTemplateController::class, 'store']);
    Route::get('/email-templates/{id}', [EmailTemplateController::class, 'show']);
    Route::put('/email-templates/{id}', [EmailTemplateController::class, 'update']);
    Route::delete('/email-templates/{id}', [EmailTemplateController::class, 'destroy']);
    Route::post('/email-templates/{id}/send', [EmailTemplateController::class, 'send']);

    // Newsletter subscribers
    Route::get('/newsletter/subscribers', [NewsletterController::class, 'index']);
    Route::delete('/newsletter/subscribers/{id}', [NewsletterController::class, 'destroy']);

    Route::get('/contact-messages', [ContactMessageController::class, 'index']);
    Route::put('/contact-messages/{id}/read', [ContactMessageController::class, 'markAsRead']);
    Route::delete('/contact-messages/{id}', [ContactMessageController::class, 'destroy']);
});
