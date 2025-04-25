<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Service;
use App\Notifications\AppointmentReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['client', 'service', 'employee'])->get();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $clients = Client::all();
        $services = Service::all();
        $employees = Employee::all();
        return view('appointments.create', compact('clients', 'services', 'employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'service_id' => 'required|exists:services,id',
            'employee_id' => 'required|exists:employees,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'in:pending,confirmed,completed',
        ]);

        $appointment = Appointment::create($validated);

        // Envoyer une notification par email via Brevo
        try {
            $client = Client::find($validated['client_id']);
            if ($client) {
                Log::info('Attempting to send notification to client: ' . $client->email);
                Notification::send($client, new AppointmentReminder('Appointment Scheduled', 'Your appointment is scheduled for ' . $validated['start_time']));
                Log::info('Notification sent successfully to: ' . $client->email);
                return redirect()->route('appointments.index')->with('success', __('Appointment created successfully and email sent to ') . $client->email);
            } else {
                Log::warning('Client not found for ID: ' . $validated['client_id']);
                return redirect()->route('appointments.index')->with('error', __('Appointment created successfully, but client not found for email notification'));
            }
        } catch (\Exception $e) {
            Log::error('Failed to send notification: ' . $e->getMessage());
            return redirect()->route('appointments.index')->with('error', __('Appointment created successfully, but email could not be sent: ') . $e->getMessage());
        }
    }

    public function edit(Appointment $appointment)
    {
        $clients = Client::all();
        $services = Service::all();
        $employees = Employee::all();
        return view('appointments.edit', compact('appointment', 'clients', 'services', 'employees'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'service_id' => 'required|exists:services,id',
            'employee_id' => 'required|exists:employees,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'in:pending,confirmed,completed',
        ]);

        $appointment->update($validated);
        return redirect()->route('appointments.index')->with('success', __('Appointment updated successfully'));
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', __('Appointment deleted successfully'));
    }
}
