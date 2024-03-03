<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        $events = Event::with('country')->get();
        $users = User::all();
        return view('users.index',compact('events','users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View
    {
        $countries = Country::all();
        $tags = Tag::all();
        return view('events.edit', compact('countries', 'tags', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::delete($event->image);
            $data['image'] = Storage::putFile('events', $request->file('image'));
        }

        $data['slug'] = Str::slug($request->title);
        $event->update($data);
        $event->tags()->sync($request->tags);
        return to_route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        Storage::delete($event->image);
        $event->tags()->detach();
        $event->delete();
        return to_route('events.index');
    }
}
