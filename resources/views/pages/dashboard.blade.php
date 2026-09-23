<x-layouts.app game>
    <main class="rules-screen">
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
