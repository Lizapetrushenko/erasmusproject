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
            <a class="rules-button" href="{{ route('game') }}#choose-level">Go to choose the quiz</a>
        </div>
    </main>
</x-layouts.app>
