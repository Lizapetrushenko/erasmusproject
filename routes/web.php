<?php

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

Route::get('/register', function () {
    return view('app');
})->name('register');

Route::get('/questions', function () {
    return view('questions');
})->name('questions');



if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}