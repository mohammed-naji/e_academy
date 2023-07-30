<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherTimesController;

Route::prefix('/teacher')->name('teacher.')->middleware('auth:teacher')->group(function() {
    Route::get('/home', [TeacherController::class, 'index'])->name('home');
    Route::get('/courses', [TeacherController::class, 'courses'])->name('courses');
    Route::get('/appointment', [TeacherController::class, 'appointment'])->name('appointment');

    Route::get('/course/{id}/students', [TeacherController::class, 'course_students'])->name('course_students');

    Route::get('/profile', [TeacherController::class, 'profile'])->name('profile');
    Route::put('/profile', [TeacherController::class, 'profile_update']);

    Route::get('/profile/password', [TeacherController::class, 'profile_password'])->name('profile_password');
    Route::put('/profile/password', [TeacherController::class, 'profile_password_update']);

    Route::get('/appointment/{id}/{status}', [TeacherController::class, 'appointment_status'])->name('appointment_status');

    Route::resource('times', TeacherTimesController::class);
});
