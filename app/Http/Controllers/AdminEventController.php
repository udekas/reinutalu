<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
         return Event::with('users:id,name,email')->get();
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
        ]);

        $event->update($validated);
        return response()->json($event);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }

    public function show(Event $event)
    {
        return response()->json([
            'event' => $event->load('users'),
        ]);
    }
}