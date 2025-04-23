<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // default to 10 per page

        $query = User::query()->withCount('events');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('name')->paginate($perPage)->withQueryString();

        // Get all events for the modal dropdowns
        $events = Event::select('id', 'title')->orderBy('date')->get();

        return Inertia::render('AdminUsers', [
            'users' => $users->items(),
            'events' => $events,
            'totalUsers' => $users->total(),
            'perPage' => $users->perPage(),
        ]);
    }

    public function getUserEvents(User $user)
    {
        $events = $user->events()->select('id', 'title')->get();

        return response()->json([
            'events' => $events,
        ]);
    }

    public function saveUserEvents(Request $request, User $user)
    {
        $request->validate([
            'event_ids' => 'required|array',
            'event_ids.*' => 'exists:events,id',
        ]);

        $user->events()->sync($request->event_ids);

        return response()->json([
            'message' => 'User event registrations updated successfully',
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }
}
