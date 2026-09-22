<?php

use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\ScoreController;
use Illuminate\Support\Facades\Route;

Route::get('/quizzes', [QuizController::class, 'index']);
Route::get('/quizzes/difficulty/{difficulty}', [QuizController::class, 'byDifficulty']);
Route::get('/quizzes/{quiz}', [QuizController::class, 'show']);
Route::post('/quizzes/{quiz}/start', [QuizController::class, 'start']);
Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit']);
Route::get('/leaderboard', [QuizController::class, 'leaderboard']);

Route::get('/scores', [ScoreController::class, 'index']);
Route::post('/scores', [ScoreController::class, 'store']);
Route::get('/scores/{score}', [ScoreController::class, 'show']);