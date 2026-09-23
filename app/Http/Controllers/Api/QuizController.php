<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Result;
use App\Support\Level;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class QuizController extends Controller
{
    private const DAILY_CHALLENGE_BONUS = 25;

    public function index()
    {
        return response()->json([
            'data' => Question::query()
                ->selectRaw('country as slug, country as name, difficulty, count(*) as question_count')
                ->groupBy('country', 'difficulty')
                ->orderBy('country')
                ->orderBy('difficulty')
                ->get(),
        ]);
    }

    public function show(string $quiz)
    {
        $questions = $this->questionsFor($quiz)->get();

        abort_if($questions->isEmpty(), 404, 'Quiz not found.');

        return response()->json([
            'quiz' => $quiz,
            'data' => $questions->map(fn (Question $question) => $this->questionData($question)),
        ]);
    }

    public function byDifficulty(string $difficulty)
    {
        abort_unless(in_array($difficulty, ['easy', 'medium', 'hard'], true), 422, 'Invalid difficulty.');

        $questions = Question::query()
            ->where('difficulty', $difficulty)
            ->orderBy('country')
            ->orderBy('id')
            ->get();

        return response()->json([
            'difficulty' => $difficulty,
            'total_questions' => $questions->count(),
            'data' => $questions->map(fn (Question $question) => $this->questionData($question)),
        ]);
    }

    public function start(Request $request, string $quiz)
    {
        $validated = $request->validate([
            'difficulty' => ['sometimes', Rule::in(['easy', 'medium', 'hard'])],
        ]);

        $difficulty = $validated['difficulty'] ?? 'medium';
        $user = $request->user();
        $level = $user->level();

        abort_unless(
            Level::unlocksDifficulty($level, $difficulty),
            403,
            ucfirst($difficulty)." difficulty unlocks at a higher level. Your level: ".Level::label($level).'.'
        );

        $questionIds = $this->questionsFor($quiz)
            ->where('difficulty', $difficulty)
            ->inRandomOrder()
            ->limit(10)
            ->pluck('id')
            ->all();

        abort_if(count($questionIds) < 10, 422, 'This quiz needs at least 10 questions.');

        $sessionId = (string) Str::uuid();
        Cache::put($this->sessionKey($sessionId), [
            'user_id' => $user->id,
            'question_ids' => $questionIds,
            'current_index' => 0,
            'lives' => 3,
            'correct_answers' => 0,
            'score' => 0,
        ], now()->addHours(2));

        return response()->json([
            'session_id' => $sessionId,
            'quiz' => $quiz,
            'difficulty' => $difficulty,
            'lives' => 3,
            'question_number' => 1,
            'total_questions' => 10,
            'question' => $this->questionData(Question::findOrFail($questionIds[0])),
        ], 201);
    }

    public function submit(Request $request, string $quiz)
    {
        $validated = $request->validate([
            'session_id' => ['required', 'uuid'],
            'answer' => ['required', 'in:a,b,c,d'],
        ]);

        $key = $this->sessionKey($validated['session_id']);
        $session = Cache::get($key);

        abort_if($session === null, 404, 'Quiz session not found or expired.');

        $questionId = $session['question_ids'][$session['current_index']];
        $question = Question::findOrFail($questionId);
        $isCorrect = $validated['answer'] === $question->correct_option;

        if ($isCorrect) {
            $session['correct_answers']++;
            $session['score'] += $this->pointsFor($question->difficulty);
        } else {
            $session['lives']--;
        }

        $session['current_index']++;
        $isFinished = $session['lives'] === 0 || $session['current_index'] === 10;

        if ($isFinished) {
            $playedToday = Result::query()
                ->where('user_id', $session['user_id'])
                ->whereDate('date', now()->toDateString())
                ->exists();

            $bonusPoints = $playedToday ? 0 : self::DAILY_CHALLENGE_BONUS;

            $result = Result::create([
                'user_id' => $session['user_id'],
                'score' => $session['score'] + $bonusPoints,
                'correct_answers' => $session['correct_answers'],
                'remaining_lives' => $session['lives'],
                'bonus_points' => $bonusPoints,
                'is_daily_bonus' => $bonusPoints > 0,
                'date' => now()->toDateString(),
            ]);

            Cache::forget($key);

            return response()->json([
                'finished' => true,
                'result' => [
                    'result_id' => $result->id,
                    'correct_answers' => $session['correct_answers'],
                    'remaining_lives' => $session['lives'],
                    'total_score' => $result->score,
                    'bonus_points' => $bonusPoints,
                    'is_daily_bonus' => $bonusPoints > 0,
                ],
            ]);
        }

        Cache::put($key, $session, now()->addHours(2));
        $nextQuestion = Question::findOrFail($session['question_ids'][$session['current_index']]);

        return response()->json([
            'finished' => false,
            'correct' => $isCorrect,
            'lives' => $session['lives'],
            'score' => $session['score'],
            'question_number' => $session['current_index'] + 1,
            'question' => $this->questionData($nextQuestion),
        ]);
    }

    public function leaderboard()
    {
        $rows = Result::query()
            ->selectRaw('user_id, sum(score) as score, count(*) as quizzes_completed')
            ->with('user:id,name')
            ->groupBy('user_id')
            ->orderByDesc('score')
            ->get();

        $rows->each(function ($row) {
            $row->level = Level::label(Level::forScore((int) $row->score));
        });

        return response()->json([
            'data' => $rows,
        ]);
    }

    private function questionsFor(string $quiz)
    {
        return Question::query()
            ->where('country', $quiz)
            ->orWhere('category', $quiz)
            ->orderBy('id');
    }

    private function sessionKey(string $sessionId): string
    {
        return 'quiz-session:'.$sessionId;
    }

    private function pointsFor(string $difficulty): int
    {
        return match ($difficulty) {
            'easy' => 10,
            'medium' => 15,
            'hard' => 20,
            default => 10,
        };
    }

    private function questionData(Question $question): array
    {
        return [
            'id' => $question->id,
            'question_text' => $question->question_text,
            'options' => [
                'a' => $question->option_a,
                'b' => $question->option_b,
                'c' => $question->option_c,
                'd' => $question->option_d,
            ],
            'category' => $question->category,
            'country' => $question->country,
            'difficulty' => $question->difficulty,
        ];
    }
}
