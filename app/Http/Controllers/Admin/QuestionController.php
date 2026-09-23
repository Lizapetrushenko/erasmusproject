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
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'country' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'string', 'max:100'],
        ]);

        $query = Question::query();
        if (! empty($filters['country'])) {
            $query->where('country', $filters['country']);
        }
        if (! empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        return view('admin.questions.index', [
            'questions' => $query->orderBy('country')->orderBy('category')->orderBy('difficulty')->paginate(20)->withQueryString(),
            'countries' => Question::query()->select('country')->distinct()->orderBy('country')->pluck('country'),
            'categories' => Question::query()->select('category')->distinct()->orderBy('category')->pluck('category'),
            'selectedCountry' => $filters['country'] ?? '',
            'selectedCategory' => $filters['category'] ?? '',
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
            'question_text' => ['required', 'string', 'max:5000'],
            'option_a' => ['required', 'string', 'max:255'],
            'option_b' => ['required', 'string', 'max:255'],
            'option_c' => ['required', 'string', 'max:255'],
            'option_d' => ['required', 'string', 'max:255'],
            'correct_option' => ['required', Rule::in(['a', 'b', 'c', 'd'])],
            'category' => ['required', 'string', 'max:100'],
            'country' => ['required', Rule::in(['Croatia', 'Netherlands', 'Sweden'])],
            'difficulty' => ['required', Rule::in(['easy', 'medium', 'hard'])],
        ]);
    }
}
