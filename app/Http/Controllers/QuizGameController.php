<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Result;
use App\Support\Level;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuizGameController extends Controller
{
    public function start(Request $request)
    {
        $data = $request->validate([
            'country' => ['required', 'string', 'max:100'],
            'difficulty' => ['required', Rule::in(['easy', 'medium', 'hard'])],
        ]);

        abort_unless(
            Level::unlocksDifficulty($request->user()->level(), $data['difficulty']),
            403,
            __('This difficulty is locked. Earn more points to unlock it.')
        );

        $questionIds = Question::query()
            ->where('country', $data['country'])
            ->where('difficulty', $data['difficulty'])
            ->inRandomOrder()
            ->limit(10)
            ->pluck('id')
            ->all();

        if (count($questionIds) < 10) {
            return back()->withErrors(['country' => 'This quiz does not have enough questions yet.']);
        }

        $request->session()->put('quiz', [
            'question_ids' => $questionIds,
            'index' => 0,
            'lives' => 3,
            'score' => 0,
            'correct_answers' => 0,
            'difficulty' => $data['difficulty'],
            'country' => $data['country'],
            'question_started_at' => now()->timestamp,
        ]);

        return redirect()->route('quiz.show');
    }

    public function show(Request $request)
    {
        $quiz = $request->session()->get('quiz');

        abort_if(! $quiz, 404, 'Start a quiz first.');

        if (empty($quiz['question_started_at'])) {
            $quiz['question_started_at'] = now()->timestamp;
            $request->session()->put('quiz', $quiz);
        }

        $feedback = $quiz['feedback'] ?? null;

        return view('pages.quiz', [
            'quiz' => $quiz,
            'question' => Question::findOrFail($quiz['question_ids'][$quiz['index']]),
            'secondsRemaining' => $feedback ? 0 : max(1, 20 - (now()->timestamp - $quiz['question_started_at'])),
            'feedback' => $feedback,
        ]);
    }

    public function answer(Request $request)
    {
        $quiz = $request->session()->get('quiz');
        abort_if(! $quiz, 404, 'Quiz session not found.');

        if (isset($quiz['feedback'])) {
            unset($quiz['feedback']);
            $quiz['index']++;
            $quiz['question_started_at'] = now()->timestamp;
            return $this->advance($request, $quiz);
        }

        $expired = now()->timestamp - ($quiz['question_started_at'] ?? now()->timestamp) >= 20;
        $answer = $expired ? null : $request->validate([
            'answer' => ['required', Rule::in(['a', 'b', 'c', 'd'])],
        ])['answer'];
        $question = Question::findOrFail($quiz['question_ids'][$quiz['index']]);

        $isCorrect = $answer !== null && $answer === $question->correct_option;
        if ($isCorrect) {
            $quiz['correct_answers']++;
            $quiz['score'] += match ($quiz['difficulty']) {
                'easy' => 10,
                'medium' => 15,
                'hard' => 20,
            };
        } else {
            $quiz['lives']--;
        }

        $quiz['feedback'] = ['answer' => $answer, 'correct_option' => $question->correct_option, 'correct' => $isCorrect];
        $request->session()->put('quiz', $quiz);
        return redirect()->route('quiz.show');
    }

    private function advance(Request $request, array $quiz)
    {
        $finished = $quiz['lives'] <= 0 || $quiz['index'] >= count($quiz['question_ids']);

        if ($finished) {
            Result::create([
                'user_id' => $request->user()->id,
                'score' => $quiz['score'],
                'correct_answers' => $quiz['correct_answers'],
                'remaining_lives' => max(0, $quiz['lives']),
                'date' => now()->toDateString(),
            ]);
            $request->session()->flash('quiz_result', [
                'score' => $quiz['score'],
                'correct_answers' => $quiz['correct_answers'],
                'remaining_lives' => max(0, $quiz['lives']),
            ]);
            $request->session()->forget('quiz');

            return redirect()->route('congratulations', ['score' => $quiz['score']]);
        }

        $request->session()->put('quiz', $quiz);

        return redirect()->route('quiz.show');
    }
}
