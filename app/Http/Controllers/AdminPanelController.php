<?php

namespace App\Http\Controllers;


use App\Models\Trip;
use App\Models\User;
use ILluminate\Http\Request;

class AdminPanelController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        // Fetch trips data
        $trips = Trip::all(); // or use appropriate query to get the trips
        //$trips = Trip::all();

        return view('admin-panel', compact('users', 'trips'));
    }
}