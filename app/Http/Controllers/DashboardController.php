<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // This method can be used to return a view for the dashboard
        // For example, you might want to return a view with some statistics or logs
        $clients = auth()->user()->clients;
        return view('dashboard.index', compact('clients'));
    }
}
