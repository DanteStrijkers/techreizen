<?php

namespace App\Http\Controllers;
use App\Mail\TripMessageMail;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Mail;
use App\Models\User;
use App\Models\Trip;
use App\Models\Traveller;
use app\Mail\InfoMail;

class AdminPanelController extends Controller
{
    public function index()
    {
        $travellers = Traveller::with('trip')->get(); // Eager load the trip relationship
        #$trips = Trip::all(); // Assuming trips are also used in the view
        $trips = Trip::withCount(['traveller as participants_count'])->get();

        return view('admin-panel', compact('travellers', 'trips'));
    }

    public function sendTripMessage(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'message' => 'required|string|max:1000',
        ]);

        $trip = Trip::with('participants')->find($validated['trip_id']);
        $admin = auth()->user();

        if ($trip->participants->isEmpty()) {
            return back()->with('error', 'Deze trip heeft geen deelnemers.');
        }

        try {
            foreach ($trip->participants as $participant) {
                Mail::to($participant->email)
                    ->queue(new InfoMail(
                        $trip->name,
                        $admin->name,
                        $participant->name,
                        $validated['message']
                    ));
            }

            return back()->with('success', 
                "Bericht verzonden naar {$trip->participants->count()} deelnemers van {$trip->name}");

        } catch (\Exception $e) {
            \Log::error("Fout bij verzenden tripberichten: " . $e->getMessage());
            return back()->with('error', 'Er ging iets fout bij het verzenden.');
        }
    }
}