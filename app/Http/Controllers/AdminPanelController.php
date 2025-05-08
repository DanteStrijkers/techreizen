<?php

namespace App\Http\Controllers;


use App\Models\User;
use ILluminate\Http\Request;

class AdminPanelController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        //$trips = Trip::all();

        return view('admin-panel', compact('users', /*'trips'*/));
    }
}