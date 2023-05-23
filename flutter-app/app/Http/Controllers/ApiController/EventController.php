<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $events = new Event();
        $events->name = $request->input('name');
        $events->eventdate = $request->input('eventdate');
        $events->save();
        return response()->json($events);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $events = Event::find($id);
        return response()->json($events);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $events = Event::find($id);
        $events->name = $request->input('name');
        $events->eventdate = $request->input('eventdate');
        $events->save();
        return response()->json($events);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $events = Event::find($id);
        $events->delete();
        return response()->json(['message' => 'Events deleted']);
    }
}
