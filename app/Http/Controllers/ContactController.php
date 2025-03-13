<?php
namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Trip;

class ContactController extends Controller
{
    // Toon het contactformulier
    public function showContactForm(): View
    {
        $trips = Trip::all(); // get all trips from database

        return view('contact')
            ->with('trips', $trips); // pass trips to view
    }

    // Verwerk het ingediende formulier
    public function submitContactForm(Request $request): RedirectResponse
    {
        // Validatie van de formuliergegevens
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'trip' => ['required'],
            'message' => ['required', 'string'],
            'cf-turnstile-response' => ['required'],
        ], [
            'cf-turnstile-response.required' => 'CAPTCHA challenge failed. Please try again.',
        ]);

        // Hier kun je de gegevens verwerken, bijvoorbeeld opslaan in de database of versturen via e-mail
        $contqctEmail = $request->input('subject');

        // Geef een succesbericht terug naar de gebruiker
        return back()->with('success', __('Message send successful!'));
    }
}
