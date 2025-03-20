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
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'trip' => ['required'],
            'message' => ['required', 'string', 'max:1000'],
            'cf-turnstile-response' => ['required'],
        ], [
            'cf-turnstile-response.required' => 'CAPTCHA challenge failed. Please try again.',
        ]);

        // get selected trip and contact email
        $tripId = $request->input('trip');
        $trip = Trip::find($tripId);
        $mail = $request->input('email');
        $destination = $trip->name;
        $tripContactEmail = $trip->contact_email;

        $data = $request->only(['name', 'email', 'message']);
        //send mail to trip adviser
        Mail::to('techreizen@gmail.com')->send(new PostMail($data, $destination));
        //confirmation mail
        Mail::to($mail)->send(new PostMail($data, $destination));
        // get first name from name
        $fullName = $request->input('name');
        $firstName = explode(' ', trim($fullName))[0]; // BUG: maybe separate input field so we can always get first name

        // redirect to confimation
        return redirect()
            ->route('contact.confirmation', ['name' => $firstName]);
    }

    // return back to contact from with success message
    public function confirmation(): View
    {
        return view('contact.confirmation');
    }
}
