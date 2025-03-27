<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Mail;
use App\Models\Trip;

class ContactController extends Controller
{
    public function showContactForm(): View
    {
        $trips = Trip::orderBy('name')->get();

        return view('contact.form')
            ->with('trips', $trips);
    }

    public function submitContactForm(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:100'],
            'trip' => ['required'],
            'message' => ['required', 'string', 'max:1000'],
            'cf-turnstile-response' => ['required'],
        ], [
            'cf-turnstile-response.required' => 'CAPTCHA challenge failed. Please try again.',
        ]);

        $tripId = $request->input('trip');
        $trip = Trip::find($tripId);

        if (!$trip) return redirect()
            ->back()
            ->withInput()
            ->withErrors(['trip' => 'The selected trip does not exist.']);

        $tripName = $trip->name;
        $tripContactEmail = $trip->contact_email;

        // get user email from form
        $userEmail = $request->input('email');

        // concatenate full name
        $userFullName = $request->input('first_name') . ' ' . $request->input('last_name');

        //REMARK: maybe send email once to trip adviser and put user in CC or send email once with multiple recipients
        try {
            // Maak een aparte instantie voor de tripadviseur
            $contactMailForTripAdvisor = new ContactMail($tripName, $userFullName, $userEmail, $request->input('message'));
            Mail::to($tripContactEmail)->queue($contactMailForTripAdvisor); // Stuur e-mail naar tripadviseur

            // Maak een aparte instantie voor de gebruiker
            $contactMailForUser = new ContactMail($tripName, $userFullName, $userEmail, $request->input('message'));
            Mail::to($userEmail)->queue($contactMailForUser); // Bevestigingsmail naar de gebruiker
        } catch (\Exception $ex) {
            \Log::error("Failed to dispatch contact mails: " . $ex->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['mail' => 'There was an error sending your message. Please try again later.']);
        }

        return redirect()
            ->route('contact.confirmation', ['name' => $request->input('first_name')]);
    }

    public function showContactConfirmation(): View
    {
        return view('contact.confirmation');
    }
}
