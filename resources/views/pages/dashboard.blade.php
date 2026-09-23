<x-layouts.app game>
    <main class="rules-screen">
        <div class="rules-header">
            <p class="eyebrow">{{ __('How to play') }}</p>
            <h1>{{ __('Game rules') }}</h1>
        </div>

        <div class="rules-grid">
            <article class="rule-card card-lives">
                <div class="rule-icon">❤️</div>
                <h2>{{ __('3 Lives') }}</h2>
                <p>{{ __('You start with three chances. Keep your streak alive.') }}</p>
            </article>

            <article class="rule-card card-wrong">
                <div class="rule-icon">❌</div>
                <h2>{{ __('Wrong answer') }}</h2>
                <p>{{ __('Every mistake costs 1 life, so choose carefully.') }}</p>
            </article>

            <article class="rule-card card-points">
                <div class="rule-icon">✅</div>
                <h2>{{ __('Scoring') }}</h2>
                <ul>
                    <li>{{ __('Easy') }} = +10</li>
                    <li>{{ __('Medium') }} = +15</li>
                    <li>{{ __('Hard') }} = +20</li>
                </ul>
            </article>

            <article class="rule-card card-questions">
                <div class="rule-icon">🎯</div>
                <h2>{{ __('Questions') }}</h2>
                <p>{{ __('You get 10 random questions from the selected quiz.') }}</p>
            </article>

            <article class="rule-card card-score">
                <div class="rule-icon">🏆</div>
                <h2>{{ __('Save your score') }}</h2>
                <p>{{ __('Your result is saved automatically after the game ends.') }}</p>
            </article>
        </div>

        <div class="rules-cta">
            <a class="rules-button" href="{{ route('levels') }}">{{ __('Go to choose the quiz') }}</a>
        </div>
    </main>
</x-layouts.app>
