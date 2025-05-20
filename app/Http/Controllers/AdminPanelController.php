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
use Yajra\DataTables\Facades\DataTables;

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

            return back()->with(
                'success',
                "Bericht verzonden naar {$trip->participants->count()} deelnemers van {$trip->name}"
            );
        } catch (\Exception $e) {
            \Log::error("Fout bij verzenden tripberichten: " . $e->getMessage());
            return back()->with('error', 'Er ging iets fout bij het verzenden.');
        }
    }
public function travellersData(Request $request)
{
    $allowed = [
    'first_name', 'last_name', 'email', 'trip', 'country', 'address',
    'gender', 'phone', 'emergency_phone_1', 'emergency_phone_2',
    'nationality', 'birthdate', 'birthplace', 'iban', 'bic',
    'medical_issue', 'medical_info', 'created_at'
];


    $fields = array_intersect($allowed, $request->input('fields', []));
    $rawColumns = array_diff($fields, ['trip']);
    $rawColumns[] = 'id';

    $query = Traveller::query()->select($rawColumns);

    if (in_array('trip', $fields)) {
        $query->with('trip:id,name');
        if (!in_array('trip_id', $rawColumns)) {
            $query->addSelect('trip_id');
        }
    }

    // 🔽 Add this to filter by trip ID
    if ($request->filled('trip_id')) {
        $query->where('trip_id', $request->input('trip_id'));
    }

    $travellers = $query->get();

    $data = $travellers->map(function ($trav) use ($fields) {
        $row = [];
        foreach ($fields as $col) {
            if ($col === 'trip') {
                $row['trip'] = $trav->trip ? $trav->trip->name : 'N/A';
            } elseif ($col === 'created_at') {
                $row['created_at'] = $trav->created_at ? $trav->created_at->format('d-m-Y H:i') : '';
            } else {
                $row[$col] = $trav->$col;
            }
        }
        $row['id'] = $trav->id;
        return $row;
    });

    return response()->json(['data' => $data]);
}

}
