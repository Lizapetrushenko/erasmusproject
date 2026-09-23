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

Route::get('/questions', function () {
    return view('questions');
})->name('questions');


Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}