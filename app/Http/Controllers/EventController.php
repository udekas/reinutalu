<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    
    
    public function index()
    {
        return Event::all();
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'start' => 'required|date|before:end',
        'end' => 'required|date|after:start',
        'description' => 'nullable|string',
    ]);

    $event = Event::create($validated);
    return response()->json($event);
}

public function update(Request $request, Event $event)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'start' => 'required|date|before:end',
        'end' => 'required|date|after:start',
        'description' => 'nullable|string',
    ]);

    $event->update($validated);
    return response()->json($event);
}


    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }

    public function getUsers($eventId)
{
    $event = Event::find($eventId);

    if (!$event) {
        return response()->json(['error' => 'Event not found'], 404);
    }

    // Assuming there is a 'users' relationship on the Event model
    return response()->json($event->users);
}
}
