<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/game', function () {
    return view('pages.dashboard');
})->middleware('auth')->name('game');

Route::get('/leaderboard', function () {
    return view('pages.leaderboard');
})->middleware('auth')->name('leaderboard');

Route::get('/profile', function () {
    return view('pages.profile');
})->middleware('auth')->name('profile');

Route::get('/login', function () {
    return view('authentication.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/forgot_password', function () {
    return view('authentication.forgot_password');
})->name('password.request');

Route::post('/forgot_password', [AuthController::class, 'forgotPassword'])->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('authentication.reset-password', [
        'token' => $token,
        'email' => request()->query('email'),
    ]);
})->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/register', function () {
    return view('authentication.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');

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