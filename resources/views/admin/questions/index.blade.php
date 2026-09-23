<x-layouts.app minimal title="Manage questions">
    <main class="admin-screen admin-questions-page">
        <header class="admin-questions-heading">
            <div>
                <a class="admin-back-link" href="{{ route('admin.dashboard') }}">← {{ __('Admin dashboard') }}</a>
                <h1>{{ __('Question bank') }}</h1>
                <p>{{ __('Organize questions by country, category and difficulty.') }}</p>
            </div>
            <a class="admin-action-primary" href="{{ route('admin.questions.create') }}"><i class="fa-solid fa-plus" aria-hidden="true"></i> {{ __('Add question') }}</a>
        </header>

        @if (session('status'))
            <p class="subtle">{{ session('status') }}</p>
        @endif

        <form class="admin-question-filters" method="GET" action="{{ route('admin.questions.index') }}">
            <label>{{ __('Country') }}
                <select name="country">
                    <option value="">{{ __('All countries') }}</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country }}" @selected($selectedCountry === $country)>{{ __($country) }}</option>
                    @endforeach
                </select>
            </label>
            <label>{{ __('Category') }}
                <select name="category">
                    <option value="">{{ __('All categories') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" @selected($selectedCategory === $category)>{{ __($category) }}</option>
                    @endforeach
                </select>
            </label>
            <button class="button" type="submit">{{ __('Filter questions') }}</button>
            @if ($selectedCountry || $selectedCategory)
                <a class="admin-filter-reset" href="{{ route('admin.questions.index') }}">{{ __('Clear filters') }}</a>
            @endif
        </form>

        <div class="admin-question-list">
            @forelse ($questions as $question)
                <article class="admin-question-row">
                    <div class="admin-question-info">
                        <div class="admin-question-tags">
                            <span>{{ __($question->country) }}</span>
                            <span>{{ $question->category }}</span>
                            <span class="difficulty-{{ $question->difficulty }}">{{ __($question->difficulty) }}</span>
                        </div>
                        <strong>{{ $question->question_text }}</strong>
                    </div>
                    <div class="admin-question-actions">
                        <a class="admin-edit-link" href="{{ route('admin.questions.edit', $question) }}"><i class="fa-solid fa-pen" aria-hidden="true"></i> {{ __('Edit') }}</a>
                        <form method="POST" action="{{ route('admin.questions.destroy', $question) }}" onsubmit="return confirm('{{ __('Delete this question?') }}');">
                            @csrf
                            @method('DELETE')
                            <button class="admin-delete-button" type="submit"><i class="fa-solid fa-trash" aria-hidden="true"></i> {{ __('Delete') }}</button>
                        </form>
                    </div>
                </article>
            @empty
                <p class="subtle">{{ __('No questions match these filters.') }}</p>
            @endforelse
        </div>

        @include('components.pagination', ['paginator' => $questions])
    </main>
</x-layouts.app>
