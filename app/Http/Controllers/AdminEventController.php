<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
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

        $validated['start'] = Carbon::parse($validated['start'], 'Europe/Tallinn')->setTimezone('UTC')->toDateTimeString();
        $validated['end'] = Carbon::parse($validated['end'], 'Europe/Tallinn')->setTimezone('UTC')->toDateTimeString();
        

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

        $validated['start'] = Carbon::parse($validated['start'], 'Europe/Tallinn')->setTimezone('UTC')->toDateTimeString();
        $validated['end'] = Carbon::parse($validated['end'], 'Europe/Tallinn')->setTimezone('UTC')->toDateTimeString();


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