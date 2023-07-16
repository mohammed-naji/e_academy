<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

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
