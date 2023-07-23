<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('/student')->name('student.')->middleware('auth')->group(function() {
    Route::get('/home', [StudentController::class, 'index'])->name('home');
    Route::get('/courses', [StudentController::class, 'courses'])->name('courses');
    Route::get('/appointment', [StudentController::class, 'appointment'])->name('appointment');
});
