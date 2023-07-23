<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->name('student.')->group(function() {
    Route::get('/home', [AdminController::class, 'index'])->name('home');
});
