<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'role', 'hours_worked'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
