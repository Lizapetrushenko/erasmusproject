<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/game', function () {
    return view('pages.game');
})->middleware(['auth'])->name('game');

Route::get('/profile', function () {
    return view('pages.profile');
})->middleware(['auth'])->name('profile');

Route::get('/leaderboard', function () {
    return view('pages.leaderboard');
})->middleware(['auth'])->name('leaderboard');

Route::get('/login', function () {
    return view('authentication.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/register', function () {
    return view('authentication.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}