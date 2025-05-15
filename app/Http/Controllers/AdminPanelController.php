<?php

namespace App\Http\Controllers;
use App\Mail\TripMessageMail;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Mail;
use App\Models\User;
use App\Models\Trip;
use app\Mail\InfoMail;
class AdminPanelController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        // Fetch trips data
        $trips = Trip::all(); // or use appropriate query to get the trips
        //$trips = Trip::all();
        $trips = Trip::withCount(['users as participants_count'])->get();

        return view('admin-panel', compact('users', 'trips'));
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