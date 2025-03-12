<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Toon het contactformulier
    public function showForm()
    {
        return view('contact'); // Zorg ervoor dat je een view hebt met deze naam
    }

    // Verwerk het ingediende formulier
    public function submitForm(Request $request)
    {
        // Validatie van de formuliergegevens
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Hier kun je de gegevens verwerken, bijvoorbeeld opslaan in de database of versturen via e-mail

        // Geef een succesbericht terug naar de gebruiker
        return back()->with('success', 'Bericht is succesvol verstuurd!');
    }
}
