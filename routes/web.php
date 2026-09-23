<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizGameController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', fn () => view('pages.dashboard'))
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/game', fn () => view('pages.dashboard'))
    ->middleware('auth')->name('game');

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

Route::get('/levels', fn () => view('pages.levels'))
    ->middleware('auth')->name('levels');

Route::get('/countries', fn () => view('pages.countries'))
    ->middleware('auth')->name('countries');

Route::post('/quiz/start', [QuizGameController::class, 'start'])
    ->middleware('auth')->name('quiz.start');
Route::get('/quiz', [QuizGameController::class, 'show'])
    ->middleware('auth')->name('quiz.show');
Route::post('/quiz/answer', [QuizGameController::class, 'answer'])
    ->middleware('auth')->name('quiz.answer');

Route::get('/congratulations', function () {
    return view('pages.congratulations');
})->name('congratulations');

Route::get('/leaderboard', fn () => view('pages.leaderboard'))
    ->middleware('auth')->name('leaderboard');

Route::get('/profile', fn () => view('pages.profile'))
    ->middleware('auth')->name('profile');
Route::put('/profile', [AuthController::class, 'updateProfile'])
    ->middleware('auth')->name('profile.update');
Route::delete('/profile', [AuthController::class, 'deleteAccount'])
    ->middleware('auth')->name('profile.delete');
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');

if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}