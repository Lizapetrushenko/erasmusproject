<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class QuestionController extends Controller
{
    public function index(): View
    {
        return view('admin.questions.index', [
            'questions' => Question::query()
                ->orderBy('country')
                ->orderBy('difficulty')
                ->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.questions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Question::create($this->validated($request));

        return redirect()->route('admin.questions.index')->with('status', 'Question created.');
    }

    public function edit(Question $question): View
    {
        return view('admin.questions.edit', ['question' => $question]);
    }

    public function update(Request $request, Question $question): RedirectResponse
    {
        $question->update($this->validated($request));

        return redirect()->route('admin.questions.index')->with('status', 'Question updated.');
    }

    public function destroy(Question $question): RedirectResponse
    {
        $question->delete();

        return redirect()->route('admin.questions.index')->with('status', 'Question deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'question_text' => ['required', 'string'],
            'option_a' => ['required', 'string'],
            'option_b' => ['required', 'string'],
            'option_c' => ['required', 'string'],
            'option_d' => ['required', 'string'],
            'correct_option' => ['required', Rule::in(['a', 'b', 'c', 'd'])],
            'category' => ['required', 'string'],
            'country' => ['required', 'string'],
            'difficulty' => ['required', Rule::in(['easy', 'medium', 'hard'])],
        ]);
    }
}
