<?php
namespace App\Http\Controllers;

use App\Mail\PostMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Mail;
use App\Models\Trip;

class ContactController extends Controller
{
    public function showContactForm(): View
    {
        $trips = Trip::orderBy('name', 'asc')->get(); // get all trips from database in alphabetical order

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

        // Hier kun je de gegevens verwerken, bijvoorbeeld opslaan in de database of versturen via e-mail
        $data = $request->only(['name', 'email', 'message']);
        Mail::to('techreizen@gmail.com')->send(new PostMail($data)); 
      
        //return back()->with('success', __('Message send successful!'));

        //enkel de voornaam meegeven
        $fullName = $request->input('name');
        $firstName = explode(' ', trim($fullName))[0];

        return redirect()->route('contact.confirmation', ['name' => $firstName])->with('success','');
      
        // get selected trip and contact email
        $tripId = $request->input('trip');
        $trip = Trip::find($tripId);
        $tripContactEmail = $trip->contact_email;
    }

    public function confirmation() 
    {
        return view('confirmationScreen');
    }
}
