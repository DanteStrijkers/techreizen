<?php
namespace App\Http\Controllers;

use App\Mail\PostMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Mail;

class ContactController extends Controller
{
    // Toon het contactformulier
    public function showContactForm(): View
    {
        return view('contact'); // Zorg ervoor dat je een view hebt met deze naam
    }

    // Verwerk het ingediende formulier
    public function submitContactForm(Request $request): RedirectResponse
    {
        // Validatie van de formuliergegevens
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string'],
            'cf-turnstile-response' => ['required'],
        ], [
            'cf-turnstile-response.required' => 'CAPTCHA challenge failed. Please try again.',
        ]);

        // Hier kun je de gegevens verwerken, bijvoorbeeld opslaan in de database of versturen via e-mail
        $data = $request->only(['name', 'email', 'message']);
        Mail::to('techreizen@gmail.com')->send(new PostMail($data)); 
        // Geef een succesbericht terug naar de gebruiker
        return back()->with('success', __('Message send successful!'));
    }
}
