<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

    function student() {
        return $this->belongsTo(User::class, 'user_id');
    }

    function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    function available_time() {
        return $this->belongsTo(AvailableTime::class);
    }
}
