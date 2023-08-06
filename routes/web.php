<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TestApiController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {

    // dd(Auth::guard('teacher')->check());

    if(Auth::guard('web')->check()) {
        return redirect('student/home');

    }

    if(Auth::guard('teacher')->check()) {

        return redirect('teacher/home');

    }

    if(Auth::guard('admin')->check()) {

        return redirect('admin/home');

    }

    return view('dashboard');
})->middleware(['auth:web,teacher,admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



// Route::get('student/home', function() {
//     return 'Student Home';
// })->name('student.home')->middleware('auth');

Route::get('products', [TestApiController::class, 'index']);





// $_SESSION['user'] = 'ddd';

// // 555565 -> time
// // 555555 -> last active

// if(time() - $_SESSION['last_active'] > 5) {
//     // session expired... logout user here or redirect him back login page.. etc
//     header("Location: logout.php");
// }
// $_SESSION['last_active'] = time();


// Front Site Routes
Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/course/{id}', [SiteController::class, 'course'])->name('course');
Route::get('/teachers/{id}', [SiteController::class, 'teacher'])->name('teacher');
Route::get('/search', [SiteController::class, 'search'])->name('search');
