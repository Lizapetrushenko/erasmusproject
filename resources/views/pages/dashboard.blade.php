<x-layouts.app game>
    <main class="rules-screen">
        <h1>Game rules</h1>
        <div class="rules-list">
            <p>❤️ <span>3 Lives</span></p>
            <p>❌ <span>Wrong answer = -1 life</span></p>
            <p>✅ <span>Correct answer:</span></p>
            <ul><li>easy level = +10 points</li><li>medium level = +15 points</li><li>hard level = +25 points</li></ul>
            <p>🎯 <span>10 random questions</span></p>
            <p>🏆 <span>Score saved automatically</span></p>
        </div>
        <a class="rules-button" href="{{ route('levels') }}">Go to choose the quiz</a>
    </main>
</x-layouts.app>
