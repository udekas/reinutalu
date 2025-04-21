<?php

use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// User dashboard route
Route::get('dashboard', function () {
    return Inertia::render('UserDashboard'); // User dashboard
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin dashboard route
Route::get('admin/dashboard', function () {
    return Inertia::render('AdminDashboard'); // Admin dashboard
})->middleware(['auth', 'admin'])->name('admin.dashboard');

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);
Route::put('/events/{event}', [EventController::class, 'update']);
Route::delete('/events/{event}', [EventController::class, 'destroy']);

// Protected routes
Route::middleware('auth')->group(function () {

    // Admin routes
    Route::prefix('admin')->middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {
        Route::get('events', [AdminEventController::class, 'index']);
        Route::post('events', [AdminEventController::class, 'store']);
        Route::put('events/{event}', [AdminEventController::class, 'update']);
        Route::delete('events/{event}', [AdminEventController::class, 'destroy']);
        Route::get('events/{event}', [AdminEventController::class, 'show']);
    });

    // User event actions
    Route::post('events/{eventId}/register', [EventRegistrationController::class, 'register']);
    Route::get('my-events', [EventRegistrationController::class, 'myEvents']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
