<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class LikedEventController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $events = Event::with('likes')->whereHas('likes', function ($q) {
            $q->where('user_id', auth()->id());
        })->get();

        return view('events.likedEvents', compact('events'));
    
    }
}
