<?php
namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Trip;

class ContactController extends Controller
{
    public function showContactForm(): View
    {
        $trips = Trip::all(); // get all trips from database

        return view('contact')
            ->with('trips', $trips); // pass trips to view
    }

    public function submitContactForm(Request $request): RedirectResponse
    {
        // validate the inputs from the form
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'trip' => ['required'],
            'message' => ['required', 'string'],
            'cf-turnstile-response' => ['required'],
        ], [
            'cf-turnstile-response.required' => 'CAPTCHA challenge failed. Please try again.',
        ]);

        // get selected trip and contact email
        $tripId = $request->input('trip');
        $trip = Trip::find($tripId);
        $tripContactEmail = $trip->contact_email;

        // return back to contact from with success message
        return back()
            /*->withInput()*/
            ->with('success', __('Message send successful!'));
    }
}
