<x-layouts.app>
    <main class="container">
        <div class="game-header"><div>
            <p class="eyebrow">{{ __('Top explorers') }}</p>
            <h2>{{ __('Leaderboard') }}</h2>
        </div><a class="button secondary" href="{{ route('game') }}">{{ __('Play a game') }}</a>
        </div>
        <section class="panel" style="max-width: 680px; margin-bottom: 80px;">
            <p class="subtle">{{ __('The highest scores from this week.') }}</p>
            <div class="side-list">
                <div class="rank">
                <span>01 &nbsp; 🇳🇱 Sophie van Dijk</span>
                <strong>980 pts</strong>
            </div>
            <div class="rank">
                <span>02 &nbsp; 🇸🇪 Erik Lindberg</span>
                <strong>920 pts</strong>
            </div>
            <div class="rank">
                <span>03 &nbsp; 🇭🇷 Ana Horvat</span>
                <strong>870 pts</strong>
            </div>
            <div class="rank">
                <span>04 &nbsp; {{ __('You') }}</span>
                <strong>530 pts</strong>
            </div>
        </div>
    </section>
</main>
</x-layouts.app>
