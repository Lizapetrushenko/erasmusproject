<x-layouts.app game>
    <main class="congratulations-screen">
        <section class="congratulations-card">
            <h1>Congratulations</h1>
            <p>You did it !!!</p>
            <p>Score: {{ request('score', 50) }}</p>
            <a class="leaderboard-button" href="{{ route('leaderboard') }}">See leaderboard</a>
            <a class="main-menu-button" href="{{ route('home') }}">go to the main menu →</a>
        </section>
    </main>
</x-layouts.app>