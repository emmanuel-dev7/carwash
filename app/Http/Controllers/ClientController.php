<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Notifications\AppointmentReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:20',
            'loyalty_points' => 'nullable|integer|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        Client::create($validated);
        return redirect()->route('clients.index')->with('success', __('Client added successfully'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
            'loyalty_points' => 'nullable|integer|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        $client->update($validated);
        return redirect()->route('clients.index')->with('success', __('Client updated successfully'));
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', __('Client deleted successfully'));
    }

    public function applyDiscount(Request $request, Client $client)
    {
        $validated = $request->validate([
            'loyalty_points_threshold' => 'required|integer|min:1',
            'discount_percentage' => 'required|numeric|min:0|max:100',
        ]);

        if ($client->loyalty_points >= $validated['loyalty_points_threshold']) {
            $client->update(['discount_percentage' => $validated['discount_percentage']]);
            Notification::send($client, new AppointmentReminder('Discount Applied', 'You have received a ' . $validated['discount_percentage'] . '% discount!'));
            return redirect()->route('clients.index')->with('success', __('Discount applied successfully'));
        }

        return redirect()->route('clients.index')->with('error', __('Not enough loyalty points'));
    }
}
