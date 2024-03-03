<?php

namespace App\Http\Controllers;

use App\Models\Event;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $events = Event::latest()->take(6)->get();

        return view('welcome', compact('events'));
    }
}