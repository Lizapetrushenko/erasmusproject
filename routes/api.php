<?php

use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\ScoreController;
use Illuminate\Support\Facades\Route;

// These same-origin API endpoints use the authenticated browser session.
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/questions', [QuizController::class, 'questions']);

    Route::get('/quizzes', [QuizController::class, 'index']);
    Route::get('/quizzes/difficulty/{difficulty}', [QuizController::class, 'byDifficulty']);
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show']);
    Route::post('/quizzes/{quiz}/start', [QuizController::class, 'start']);
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit']);

    Route::get('/scores', [ScoreController::class, 'index']);
    Route::get('/scores/{score}', [ScoreController::class, 'show']);
    Route::get('/leaderboard', [QuizController::class, 'leaderboard']);
});
