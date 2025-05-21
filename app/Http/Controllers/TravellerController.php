<?php

namespace App\Http\Controllers;

use App\Models\Traveller;
use Illuminate\Http\Request;
use App\Models\Trip;

class TravellerController extends Controller
{
    public function update(Request $request, $id)
    {
        $traveller = Traveller::findOrFail($id);

        $traveller->update($request->only([
            'first_name', 'last_name', 'email', 'trip_id', 'country', 'address', 
            'gender', 'phone', 'emergency_phone_1', 'emergency_phone_2',
            'nationality', 'birthdate', 'birthplace', 'iban', 'bic',
            'medical_issue', 'medical_info'
        ]));

        return redirect()->route('admin.panel')
                         ->with('success', 'Traveller updated successfully');
    }

    public function edit($id)
    {
        $traveller = Traveller::findOrFail($id);
        $trips = Trip::all();
        return view('traveller.edit', compact('traveller', 'trips'));
    }
    public function destroy($id)
    {
        $traveller = Traveller::findOrFail($id);
        $traveller->delete();

        return redirect()->route('admin.panel')
                         ->with('success', 'Traveller deleted successfully');
    }
}
