<?php

use App\Http\Controllers\frontController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('dashboard', [frontController::class, 'index'] )->name('dashboard');;

Route::prefix('dashboard')->middleware(['auth', 'role:user'])->group(function () {
    route::get('/portal-job', function () {
        return view('User.index');
    })->name('dashboard');

    Route::resource('job', PekerjaanController::class);
    
});

Route::middleware('auth', 'role:user', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    route::get('/users', function () {
        return view('User.index');
    });
});

require __DIR__ . '/auth.php';
