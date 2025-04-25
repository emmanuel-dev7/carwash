<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use HasFactory, Notifiable; // Ajout du trait Notifiable

    protected $fillable = ['name', 'email', 'phone', 'loyalty_points', 'discount_percentage'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function applyDiscount($amount)
    {
        return $amount * (1 - $this->discount_percentage / 100);
    }

    /**
     * Définir l'adresse email pour les notifications.
     *
     * @param  string  $driver
     * @return string|null
     */
    public function routeNotificationFor($driver, $notification = null)
    {
        if ($driver === 'mail') {
            return $this->email;
        }

        return null;
    }
}
