<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

Route::get('/dashboard', function () {
    return view('app');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login', function () {
    return view('app');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/register', function () {
    return view('app');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}