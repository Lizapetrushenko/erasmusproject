<x-layouts.app game>
    <main class="rules-screen">
        <div class="rules-header">
            <p class="eyebrow">How to play</p>
            <h1>Game rules</h1>
        </div>

        <div class="rules-grid">
            <article class="rule-card card-lives">
                <div class="rule-icon">❤️</div>
                <h2>3 lives</h2>
                <p>You start with three chances. Keep your streak alive.</p>
            </article>

            <article class="rule-card card-wrong">
                <div class="rule-icon">❌</div>
                <h2>Wrong answer</h2>
                <p>Every mistake costs 1 life, so choose carefully.</p>
            </article>

            <article class="rule-card card-points">
                <div class="rule-icon">✅</div>
                <h2>Scoring</h2>
                <ul>
                    <li>Easy = +10</li>
                    <li>Medium = +15</li>
                    <li>Hard = +20</li>
                </ul>
            </article>

            <article class="rule-card card-questions">
                <div class="rule-icon">🎯</div>
                <h2>Questions</h2>
                <p>You get 10 random questions from the selected quiz.</p>
            </article>

            <article class="rule-card card-score">
                <div class="rule-icon">🏆</div>
                <h2>Save your score</h2>
                <p>Your result is saved automatically after the game ends.</p>
            </article>
        </div>

        <div class="rules-cta">
            <a class="rules-button" href="{{ route('levels') }}">Go to choose the quiz</a>
        </div>
        <h1>{{ __('Game rules') }}</h1>
        <div class="rules-list">
            <p>❤️ <span>{{ __('3 Lives') }}</span></p>
            <p>❌ <span>{{ __('Wrong answer = -1 life') }}</span></p>
            <p>✅ <span>{{ __('Correct answer:') }}</span></p>
            <ul><li>{{ __('easy level = +10 points') }}</li><li>{{ __('medium level = +15 points') }}</li><li>{{ __('hard level = +20 points') }}</li></ul>
            <p>🎯 <span>{{ __('10 random questions') }}</span></p>
            <p>🏆 <span>{{ __('Score saved automatically') }}</span></p>
        </div>
        <a class="rules-button" href="{{ route('game') }}#choose-level">{{ __('Go to choose the quiz') }}</a>
    </main>
</x-layouts.app>
