<?php


    namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'datetime' => 'required|date',
            'message' => 'nullable|string',
        ]);

        Mail::raw("Uus broneering:\n\n"
            . "Nimi: {$validated['name']}\n"
            . "E-post: {$validated['email']}\n"
            . "Aeg: {$validated['datetime']}\n"
            . "Sõnum: {$validated['message']}", function ($message) use ($validated) {
            $message->to('sinu@epost.ee') // <- siia oma e-post
                    ->subject('Uus hobusesõidu broneering');
        });

        return back();
    }
}

