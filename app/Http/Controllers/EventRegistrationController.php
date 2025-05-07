<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRegistrationController extends Controller
{
    // Show all available events to the user
    public function index()
    {
        return Event::all();
    }

    // Register the user for a specific event
    public function register(Request $request, $eventId)
    {
        $user = Auth::user();

        // Find the event, or throw 404 if not found
        $event = Event::findOrFail($eventId);

        // Check if the user is already registered in the pivot table
        if (!$user->events()->where('event_id', $eventId)->exists()) {
            // Attach the event to the user
            $user->events()->attach($eventId);
            return response()->json(['message' => 'Registered for the event successfully']);
        }

        return response()->json(['message' => 'You are already registered for this event'], 409);
    }

    // Unregister the user from a specific event
    public function unregister(Request $request, $eventId)
{
    $event = Event::findOrFail($eventId); // Find the event
    $user = $request->user(); // Get the authenticated user

    // Check if the user is registered for the event
    if ($event->users()->where('user_id', $user->id)->exists()) {
        $event->users()->detach($user->id); // Remove the user's registration
        return response()->json(['message' => 'Successfully unregistered from the event'], 200);
    }

    return response()->json(['message' => 'User is not registered for this event'], 404);
}

    // Get the events the currently authenticated user is registered for
    public function myEvents(Request $request)
    {
        // Get the currently authenticated user
        $user = $request->user();

        // Fetch all events the user is registered for
        $events = $user->events;

        return response()->json($events);
    }

    public function adminUnregister($eventId, $userId)
{
    $event = Event::findOrFail($eventId);

    if ($event->users()->where('user_id', $userId)->exists()) {
        $event->users()->detach($userId);
        return response()->json(['message' => 'User successfully unregistered from event']);
    }

    return response()->json(['message' => 'User was not registered for this event'], 404);
}
}
