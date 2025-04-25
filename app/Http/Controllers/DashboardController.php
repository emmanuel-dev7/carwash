<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClients = Client::count();
        $totalAppointments = Appointment::count();
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');
        $popularServices = Service::withCount('appointments')
            ->orderBy('appointments_count', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('totalClients', 'totalAppointments', 'totalRevenue', 'popularServices'));
    }
}
