<x-layouts.app game>
    <main class="quiz-screen">
        <div class="quiz-status"><span>{{ __('Question :current of :total', ['current' => $quiz['index'] + 1, 'total' => count($quiz['question_ids'])]) }}</span><span>{{ __('Time left:') }} <strong id="question-timer" data-seconds="{{ $secondsRemaining }}">{{ $secondsRemaining }}</strong>s</span></div>
        <h1>{{ $question->question_text }}</h1>
        <form class="quiz-answers" id="quiz-answer-form" method="POST" action="{{ route('quiz.answer') }}">
            @csrf
            <input type="hidden" name="timed_out" value="1" disabled>
            @foreach (['a' => $question->option_a, 'b' => $question->option_b, 'c' => $question->option_c, 'd' => $question->option_d] as $letter => $option)
                <button type="submit" name="answer" value="{{ $letter }}"><strong>{{ strtoupper($letter) }}</strong><span>{{ $option }}</span></button>
            @endforeach
        </form>
        <p class="quiz-lives">{{ __('Lives:') }} {{ $quiz['lives'] }}</p>
    </main>
    <script>
        (() => {
            const timer = document.querySelector('#question-timer');
            const form = document.querySelector('#quiz-answer-form');
            let seconds = Number(timer?.dataset.seconds || 20);
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
