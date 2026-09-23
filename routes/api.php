<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\QuizController;
use Illuminate\Support\Facades\Route;

Route::get('/questions', [QuizController::class, 'questions']);
Route::post('/questions/submit', [QuizController::class, 'submitQuestion']);

Route::get('/quizzes', [QuizController::class, 'index']);
Route::get('/quizzes/difficulty/{difficulty}', [QuizController::class, 'byDifficulty']);
Route::get('/quizzes/{quiz}', [QuizController::class, 'show']);
Route::post('/quizzes/{quiz}/start', [QuizController::class, 'start']);
Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit']);
Route::get('/leaderboard', [QuizController::class, 'leaderboard']);

Route::get('/scores', [QuizController::class, 'scores']);
Route::post('/scores', [QuizController::class, 'storeScore']);
Route::get('/leaderboard', [QuizController::class, 'leaderboard']);
