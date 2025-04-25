<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProfileController;
use App\Models\Client;
use App\Notifications\AppointmentReminder;
use Illuminate\Http\Request; // Importation correcte
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('clients', ClientController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('employees', EmployeeController::class);
    Route::post('clients/{client}/apply-discount', [ClientController::class, 'applyDiscount'])->name('clients.apply-discount');
    Route::resource('appointments', AppointmentController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route pour afficher le formulaire de test d'email
    Route::get('/test-email', function () {
        $clients = Client::all();
        return view('test-email', compact('clients'));
    })->name('test-email');

    // Route pour envoyer l'email de test
    Route::post('/test-email', function (Request $request) {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
        ]);

        try {
            $client = Client::findOrFail($validated['client_id']);
            Log::info('Attempting to send test email to client: ' . $client->email);
            Notification::send($client, new AppointmentReminder('Test Email', 'This is a test email sent via Brevo.'));
            Log::info('Test email sent successfully to: ' . $client->email);
            return redirect()->route('test-email')->with('success', __('Test email sent to ') . $client->email);
        } catch (\Exception $e) {
            Log::error('Failed to send test email: ' . $e->getMessage());
            return redirect()->route('test-email')->with('error', __('Failed to send test email: ') . $e->getMessage());
        }
    })->name('test-email.send');
});

require __DIR__.'/auth.php';
