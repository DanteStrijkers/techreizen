<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trip;

class AdminPanelController extends Controller
{
    public function showAdminPanel()
    {
        $users = User::all();
        $trips = Trip::all();

        return view('admin-panel', [
            'users' => $users,
            'trips' => $trips,
        ]);
    }
}