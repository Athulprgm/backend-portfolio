<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Middleware\AdminApiKey;
use Illuminate\Support\Facades\Route;

// ── Public read-only endpoints ─────────────────────────────────────────────
Route::get('/projects',      [ProjectController::class, 'index']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);

// ── Admin CRUD endpoints (protected by API key) ────────────────────────────
Route::middleware(AdminApiKey::class)->prefix('admin')->group(function () {
    Route::get('/projects',         [ProjectController::class, 'adminIndex']);
    Route::post('/projects',        [ProjectController::class, 'store']);
    Route::put('/projects/{id}',    [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
});
