<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    function student() {
        return $this->belongsTo(User::class);
    }

    function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    function available_time() {
        return $this->belongsTo(AvailableTime::class);
    }
}
