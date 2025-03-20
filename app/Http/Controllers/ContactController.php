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
        $trips = Trip::orderBy('name', 'asc')->get();

        return view('contact.form')
            ->with('trips', $trips);
    }

    public function submitContactForm(Request $request): RedirectResponse
    {
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

        $data = $request->only(['name', 'email', 'message']);
        Mail::to('techreizen@gmail.com')->send(new PostMail($data));

        // get first name from name
        $fullName = $request->input('name');
        $firstName = explode(' ', trim($fullName))[0]; // BUG: maybe separate input field so we can always get first name

        return redirect()
            ->route('contact.confirmation', ['name' => $firstName]);
    }

    public function showContactConfirmation() : View
    {
        return view('contact.confirmation');
    }
}
