<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRegistrationController extends Controller
{
    public function index()
    {
        // Show all available events to the user
        return Event::all();
    }

    public function register(Request $request, $eventId)
    {
        $user = Auth::user();

        // Find the event, or throw 404 if not found
        $event = Event::findOrFail($eventId);

        // Check if the user is already registered
        if (!$user->events->contains($eventId)) {
            $user->events()->attach($eventId);
            return response()->json(['message' => 'Registered for the event successfully']);
        }

        return response()->json(['message' => 'You are already registered for this event'], 409);
    }

    public function myEvents()
    {
        // Return all events the user has registered for
        return Auth::user()->events;
    }
}
