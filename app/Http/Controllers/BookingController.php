<?php


    namespace App\Http\Controllers;

use App\Mail\BookingConfirmation;
use App\Mail\BookingReceived;
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

        // 1. Send booking info to you
        Mail::to('jurgen-mark.heinmets@ametikool.ee')->send(new BookingReceived($validated));

        // 2. Send confirmation to the user
        Mail::to($validated['email'])->send(new BookingConfirmation($validated));

        return back()->with('success', 'Broneerimine saadetud!');
    }
}

