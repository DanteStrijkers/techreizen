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
    // Validatie
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'contact_email' => 'required|email|max:255',
        'price' => 'required|numeric',
        'status' => 'required|in:active,inactive',
    ]);

    // Update uitvoeren
    $trip->update($validated);

    // Redirect naar admin panel
    return redirect('/admin-panel')->with('success', 'Trip updated successfully.');
}



}