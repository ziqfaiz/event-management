<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class StoreCommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);
        return back();
    }
    
}
