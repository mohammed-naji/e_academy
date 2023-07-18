<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    if(Auth::guard('admin')->check()) {

        return redirect()->route('admin.home');

    }elseif(Auth::guard('teacher')->check()) {

        return redirect()->route('teacher.home');

    }elseif(Auth::guard('web')->check()) {

        return redirect()->route('student.home');

    }

    // return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('student/home', function() {
    return 'Student Home';
})->name('student.home')->middleware('auth');







// $_SESSION['user'] = 'ddd';

// // 555565 -> time
// // 555555 -> last active

// if(time() - $_SESSION['last_active'] > 5) {
//     // session expired... logout user here or redirect him back login page.. etc
//     header("Location: logout.php");
// }
// $_SESSION['last_active'] = time();
