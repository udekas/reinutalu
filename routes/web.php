<?php

use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/gallery', function () {
    return Inertia::render('Gallery');
})->name('gallery');

Route::get('/services', function () {
    return Inertia::render('Services');
})->name('services');

Route::get('/booking', function () {
    return Inertia::render('Booking');
})->name('booking');

// User dashboard route
Route::get('dashboard', function () {
    return Inertia::render('UserDashboard'); // User dashboard
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin dashboard route
Route::get('admin/dashboard', function () {
    return Inertia::render('AdminDashboard'); // Admin dashboard
})->middleware(['auth', 'admin'])->name('admin.dashboard');

// Admin users route
Route::get('users', [AdminUserController::class, 'index'])
    ->middleware(['auth', 'admin']) // Ensure only authenticated admins can access
    ->name('users');

    


use App\Http\Controllers\BookingController;


Route::post('/booking/send', [BookingController::class, 'send']);



// Event routes
Route::get('/events', [EventController::class, 'index']);

// Protected routes
Route::middleware('auth')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

Route::middleware('auth')->group(function () {
    // Admin routes for managing events and users
    Route::prefix('admin')->middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {
        // Event management routes
        Route::get('events', [AdminEventController::class, 'index']);
        Route::post('events', [AdminEventController::class, 'store']);
        Route::put('events/{event}', [AdminEventController::class, 'update']);
        Route::delete('events/{event}', [AdminEventController::class, 'destroy']);
        Route::get('events/{event}', [AdminEventController::class, 'show']);
        
        // User management routes
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy']);
        Route::get('users', [AdminUserController::class, 'index']);
        
        // User event management
        Route::get('users/{user}/events', [AdminUserController::class, 'getUserEvents']);
        Route::put('users/{user}/events', [AdminUserController::class, 'saveUserEvents']);
    });
    
    // User event actions for registered users
    
    Route::get('/events/{event}', [EventController::class, 'show']);
    Route::post('events/{eventId}/register', [EventRegistrationController::class, 'register']);
    Route::delete('/events/{eventId}/register', [EventRegistrationController::class, 'unregister']);
    Route::delete('/events/{eventId}/users/{userId}/unregister', [EventRegistrationController::class, 'adminUnregister']);
    
    Route::get('my-events', [EventRegistrationController::class, 'myEvents']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
