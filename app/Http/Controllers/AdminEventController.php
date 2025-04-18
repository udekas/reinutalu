<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    // Only allow admin users to access these routes
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        // Get all events to show on the admin panel
        return Event::all();
    }

    public function store(Request $request)
    {
        // Validate event data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date|before:end',
            'end' => 'required|date|after:start',
        ]);

        $event = Event::create($validated);
        return response()->json($event);
    }

    public function update(Request $request, Event $event)
    {
        // Validate event data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date|before:end',
            'end' => 'required|date|after:start',
        ]);

        $event->update($validated);
        return response()->json($event);
    }

    public function destroy(Event $event)
    {
        // Delete event
        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}