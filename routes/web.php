<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login', function () {
    return view('authentication.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/register', function () {
    return view('authentication.register');
})->name('register');

Route::get('/game', function () {
    return view('pages.dashboard');
})->name('game');

Route::get('/levels', function () {
    return view('pages.levels');
})->name('levels');

Route::get('/countries', function () {
    return view('pages.countries');
})->name('countries');

Route::get('/congratulations', function () {
    return view('pages.congratulations');
})->name('congratulations');

Route::get('/leaderboard', function () {
    return view('pages.leaderboard');
})->name('leaderboard');

Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');

if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}