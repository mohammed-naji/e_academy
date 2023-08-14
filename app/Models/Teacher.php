<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    function courses() {
        return $this->hasMany(Course::class);
    }

    function available_times() {
        return $this->hasMany(AvailableTime::class);
    }

    function appointments() {
        return $this->hasMany(Appointment::class);
    }
}
