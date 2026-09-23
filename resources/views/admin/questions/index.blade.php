<x-layouts.app minimal title="Manage questions">
    <main class="container" style="padding: 24px 0;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
            <h2>{{ __('Questions') }}</h2>
            <a class="button" href="{{ route('admin.questions.create') }}">{{ __('Add question') }}</a>
        </div>

        @if (session('status'))
            <p class="subtle">{{ session('status') }}</p>
        @endif

        <div class="side-list">
            @foreach ($questions as $question)
                <div class="rank">
                    <div>
                        <strong>{{ $question->country }}</strong> &middot; {{ $question->difficulty }} &middot; {{ $question->category }}
                        <div class="subtle">{{ Illuminate\Support\Str::limit($question->question_text, 80) }}</div>
                    </div>
                    <div style="display:flex; gap:10px; align-items:center;">
                        <a href="{{ route('admin.questions.edit', $question) }}">{{ __('Edit') }}</a>
                        <form method="POST" action="{{ route('admin.questions.destroy', $question) }}" onsubmit="return confirm('{{ __('Delete this question?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:var(--red); cursor:pointer; font:inherit;">{{ __('Delete') }}</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="margin-top:20px;">{{ $questions->links() }}</div>
    </main>
</x-layouts.app>
