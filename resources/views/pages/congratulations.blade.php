<x-layouts.app game>
    <main class="congratulations-screen">
        <section class="congratulations-card">
            <h1>{{ __('Congratulations') }}</h1>
            <p>{{ __('You did it!') }}</p>
            @if ($result)
                <p>{{ __('Correct answers:') }} {{ $result['correct_answers'] }}</p>
                <p>{{ __('Lives remaining:') }} {{ $result['remaining_lives'] }}</p>
                <p>{{ __('Total score:') }} {{ number_format($result['score']) }}</p>
            @else
                <p>{{ __('Finish a quiz to see your result here.') }}</p>
            @endif
            <a class="leaderboard-button" href="{{ route('leaderboard') }}">{{ __('See leaderboard') }}</a>
            <a class="main-menu-button" href="{{ route('levels') }}">{{ __('Go to the main menu') }} →</a>
        </section>
    </main>
</x-layouts.app>
