<?php

use App\Http\Controllers\Api\QuizController;
use Illuminate\Support\Facades\Route;

Route::get('/quizzes', [QuizController::class, 'index']);
Route::get('/quizzes/difficulty/{difficulty}', [QuizController::class, 'byDifficulty']);
Route::get('/quizzes/{quiz}', [QuizController::class, 'show']);
Route::get('/leaderboard', [QuizController::class, 'leaderboard']);