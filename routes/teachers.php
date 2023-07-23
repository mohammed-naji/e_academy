<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;

Route::prefix('/teacher')->name('teacher.')->middleware('auth:teacher')->group(function() {
    Route::get('/home', [TeacherController::class, 'index'])->name('home');
    Route::get('/courses', [TeacherController::class, 'courses'])->name('courses');
    Route::get('/appointment', [TeacherController::class, 'appointment'])->name('appointment');
});
