<x-layouts.app game>
    @php($translateQuizText = fn (string $text) => trans('questions.'.$text) === 'questions.'.$text ? $text : trans('questions.'.$text))
    <main class="quiz-screen">
        <div class="quiz-status"><span>{{ __('Question :current of :total', ['current' => $quiz['index'] + 1, 'total' => count($quiz['question_ids'])]) }}</span><span>{{ __('Time left:') }} <strong id="question-timer" data-seconds="{{ $secondsRemaining }}">{{ $secondsRemaining }}</strong>s</span></div>
        <h1>{{ $translateQuizText($question->question_text) }}</h1>
        @if ($feedback)
            <p class="quiz-feedback {{ $feedback['correct'] ? 'is-correct' : 'is-wrong' }}" role="status">
                {{ $feedback['correct'] ? __('Correct!') : __('Wrong answer') }}
            </p>
        @endif
        <form class="quiz-answers" id="quiz-answer-form" method="POST" action="{{ route('quiz.answer') }}">
            @csrf
            @if (!$feedback)<input type="hidden" name="timed_out" value="1" disabled>@endif
            @foreach (['a' => $question->option_a, 'b' => $question->option_b, 'c' => $question->option_c, 'd' => $question->option_d] as $letter => $option)
                <button type="submit" name="answer" value="{{ $letter }}" @if($feedback) disabled class="{{ $letter === $feedback['correct_option'] ? 'is-correct' : ($letter === $feedback['answer'] ? 'is-wrong' : '') }}" @endif><strong>{{ strtoupper($letter) }}</strong><span>{{ $translateQuizText($option) }}</span></button>
            @endforeach
            @if ($feedback)<button class="quiz-continue" type="submit">{{ __('Continue') }}</button>@endif
        </form>
        <p class="quiz-lives">{{ __('Lives:') }} {{ $quiz['lives'] }}</p>
    </main>
    <script>
        (() => {
            const timer = document.querySelector('#question-timer');
            const form = document.querySelector('#quiz-answer-form');
            if (!timer || !form.querySelector('[name="timed_out"]')) return;
            let seconds = Number(timer.dataset.seconds || 20);
            const interval = window.setInterval(() => {
                seconds -= 1;
                timer.textContent = Math.max(0, seconds);
                if (seconds <= 0) {
                    window.clearInterval(interval);
                    form.querySelector('[name="timed_out"]').disabled = false;
                    form.requestSubmit();
                }
            }, 1000);
        })();
    </script>
</x-layouts.app>
