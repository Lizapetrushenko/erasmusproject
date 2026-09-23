<x-layouts.app game>
    <main class="leaderboard-page">
        <header class="leaderboard-heading">
            <div>
                <p class="eyebrow">{{ __('Top explorers') }}</p>
                <h1>{{ __('Leaderboard') }}</h1>
                <p class="leaderboard-subtitle">{{ __('The highest scores from all completed quizzes.') }}</p>
            </div>
            <a class="leaderboard-play" href="{{ route('levels') }}"><span aria-hidden="true">▶</span> {{ __('Play a game') }}</a>
        </header>

        <section class="leaderboard-card" aria-label="{{ __('Leaderboard') }}">
            @forelse ($leaders as $leader)
                <article class="leaderboard-row {{ $leader->user_id === auth()->id() ? 'is-you' : '' }}">
                    <span class="leaderboard-place place-{{ min($loop->iteration, 4) }}">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <div class="leaderboard-player">
                        <strong>{{ $leader->user?->name ?? __('Deleted user') }}</strong>
                        @if ($leader->user_id === auth()->id())
                            <span class="leaderboard-you">{{ __('You') }}</span>
                        @endif
                        <small>{{ $leader->quizzes_completed }} {{ __('quizzes') }}</small>
                    </div>
                    <strong class="leaderboard-score">{{ number_format((int) $leader->total_score) }} <span>{{ __('points') }}</span></strong>
                </article>
            @empty
                <div class="leaderboard-empty">
                    <span aria-hidden="true">🏆</span>
                    <p>{{ __('No quiz results yet. Be the first to play!') }}</p>
                    <a class="leaderboard-play" href="{{ route('levels') }}">{{ __('Play a game') }} →</a>
                </div>
            @endforelse
        </section>
    </main>
</x-layouts.app>
