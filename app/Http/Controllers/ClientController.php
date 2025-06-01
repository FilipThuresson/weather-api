<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClientController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $clients = auth()->user()->clients()->latest()->get();
        return view('dashboard', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        auth()->user()->clients()->create([
            'name' => $request->name,
            'token' => Str::random(60),
        ]);
        return redirect()->route('dashboard');
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client); // optional
        $client->delete();
        return redirect()->route('dashboard');
    }

}
