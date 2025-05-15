<?php

namespace App\Http\Controllers;


use App\Models\Trip;
use Illuminate\Http\Request;
use App\Models\User; 

class TripController extends Controller
{
    public function edit(Trip $trip)
{
    //Kies hier de juiste rol voor de contactpersoon
    $admins = User::where('role', 'admin')->get(); //Pas hier de rol aan indien nodig
    //Hier kun je de rol van de admin aanpassen indien nodig

    return view('trips.edit', compact('trip', 'admins'));
}

public function update(Request $request, Trip $trip)
{
    // Validatie
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'contact_email' => 'nullable|email|max:255',
        'price' => 'required|numeric',
        'status' => 'required|in:active,inactive',
    ]);

    // Update uitvoeren
    $trip->update($validated);

    // Redirect naar admin panel
    return redirect('/admin-panel')->with('success', 'Trip updated successfully.');
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'contact_email' => 'nullable|email|max:255',
        'price' => 'required|numeric|min:0.01',
        'status' => 'required|in:active,inactive',
    ]);

    Trip::create($request->only(['name', 'description', 'contact_email', 'price', 'status']));


    return redirect('/admin-panel')->with('success', 'Trip created successfully.');
}

public function destroy(Trip $trip)
{
    // Verwijder de trip
    $trip->delete();

    // Redirect naar admin panel
    return redirect('/admin-panel')->with('success', 'Trip deleted successfully.');
}
}