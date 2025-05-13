<?php

namespace App\Http\Controllers;


use App\Models\Trip;
use ILluminate\Http\Request;

class TripController extends Controller
{
    public function edit(Trip $trip)
{
    return view('trips.edit', compact('trip'));
}

public function update(Request $request, Trip $trip)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'status' => 'required|in:active,inactive',
    ]);

    $trip->update($request->only(['name', 'description', 'price', 'status']));

    return redirect()->route('admin.panel')->with('success', 'Trip updated successfully.');
}
}