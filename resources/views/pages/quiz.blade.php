<x-layouts.app game>
    <main class="quiz-screen">
        <div class="quiz-status"><span>Question {{ $quiz['index'] + 1 }} / {{ count($quiz['question_ids']) }}</span><span>Score: {{ $quiz['score'] }}</span></div>
        <h1>{{ $question->question_text }}</h1>
        <form class="quiz-answers" method="POST" action="{{ route('quiz.answer') }}">
            @csrf
            @foreach (['a' => $question->option_a, 'b' => $question->option_b, 'c' => $question->option_c, 'd' => $question->option_d] as $letter => $option)
                <button type="submit" name="answer" value="{{ $letter }}"><strong>{{ strtoupper($letter) }}</strong><span>{{ $option }}</span></button>
            @endforeach
        </form>
        <p class="quiz-lives">Lives: {{ $quiz['lives'] }} ♥ ♥ ♥</p>
    </main>
</x-layouts.app>
