<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class AdminUserController extends Controller
{
    public function index()
{
    // Get all users with how many events they've registered for
    $users = User::withCount('events')->get();
 // Debugging line

    // Return Inertia view with user data
    return Inertia::render('AdminUsers', [
        'users' => $users,
    ]);
}
}

