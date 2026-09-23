<x-layouts.app game>
    <main class="congratulations-screen">
        <section class="congratulations-card">
            <h1>{{ __('Congratulations') }}</h1>
            <p>{{ __('You did it !!!') }}</p>
            <p>{{ __('Score:') }} {{ request('score', 50) }}</p>
            <a class="leaderboard-button" href="{{ route('leaderboard') }}">{{ __('See leaderboard') }}</a>
            <a class="main-menu-button" href="{{ route('home') }}">{{ __('go to the main menu') }} →</a>
        </section>
    </main>
</x-layouts.app>
