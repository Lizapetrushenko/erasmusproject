<?php

use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\ScoreController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizGameController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
 
    return view('welcome');
})->name('home');
 

Route::get('/dashboard', fn () => view('pages.dashboard'))
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/game', fn () => view('pages.dashboard'))
    ->middleware('auth')->name('game');

Route::get('/game', function () {
    return view('pages.game');
})->middleware(['auth'])->name('game');

Route::get('/profile', function () {
    return view('pages.profile');
})->middleware(['auth'])->name('profile');

Route::get('/leaderboard', function () {
    return view('pages.leaderboard');
})->middleware(['auth'])->name('leaderboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/scores', [ScoreController::class, 'index'])->name('scores.index');
    Route::post('/scores', [ScoreController::class, 'store'])->name('scores.store');
    Route::get('/scores/{score}', [ScoreController::class, 'show'])->name('scores.show');

    Route::post('/quizzes/{quiz}/start', [QuizController::class, 'start'])->name('quizzes.start');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
});

Route::post('/locale/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['en', 'hr', 'nl'], true), 404);

    session(['locale' => $locale]);

    return back();
})->name('locale.switch');

Route::get('/admin', function () {
    return view('admin.dashboard', [
        'usersCount' => \App\Models\User::count(),
        'questionsCount' => \App\Models\Question::count(),
        'resultsCount' => \App\Models\Result::count(),
        'recentResults' => \App\Models\Result::with('user:id,name')->orderByDesc('date')->orderByDesc('id')->paginate(20),
    ]);
})->middleware(['auth', 'admin'])->name('admin.dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('questions', AdminQuestionController::class)->except(['show']);
});

Route::get('/login', function () {
    return view('authentication.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.store');

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
    return view('pages.congratulations', ['result' => session('quiz_result')]);
})->name('congratulations');

Route::get('/leaderboard', function () {
    $leaders = \App\Models\Result::query()
        ->selectRaw('user_id, SUM(score) as total_score, COUNT(*) as quizzes_completed')
        ->with('user:id,name')
        ->groupBy('user_id')
        ->orderByDesc('total_score')
        ->limit(100)
        ->get();

    return view('pages.leaderboard', ['leaders' => $leaders]);
})->middleware('auth')->name('leaderboard');

Route::get('/profile', function () {
    return view('pages.profile', [
        'results' => request()->user()->results()->orderByDesc('date')->orderByDesc('id')->paginate(10),
        'totalScore' => request()->user()->totalScore(),
    ]);
})->middleware('auth')->name('profile');
Route::put('/profile', [AuthController::class, 'updateProfile'])
    ->middleware('auth')->name('profile.update');
Route::delete('/profile', [AuthController::class, 'deleteAccount'])
    ->middleware('auth')->name('profile.delete');
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');

if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}
