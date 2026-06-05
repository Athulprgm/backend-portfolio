<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Middleware\AdminApiKey;
use Illuminate\Support\Facades\Route;

// ── Public read-only endpoints ─────────────────────────────────────────────
Route::get('/projects',      [ProjectController::class, 'index']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);
Route::get('/version', function () {
    return response()->json([
        'version' => '1.0.3',
        'project_model_mtime' => filemtime(app_path('Models/Project.php')),
        'has_casts_property' => property_exists(\App\Models\Project::class, 'casts'),
    ]);
});

// ── Admin CRUD endpoints (protected by API key) ────────────────────────────
Route::middleware(AdminApiKey::class)->prefix('admin')->group(function () {
    Route::get('/projects',         [ProjectController::class, 'adminIndex']);
    Route::post('/projects',        [ProjectController::class, 'store']);
    Route::put('/projects/{id}',    [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
});
