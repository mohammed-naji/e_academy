<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\TeacherController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->name('admin.')->middleware('auth:admin')->group(function() {
    Route::get('/home', [AdminController::class, 'index'])->name('home');

    Route::resource('teachers', TeacherController::class);
    Route::resource('courses', CourseController::class);

});
