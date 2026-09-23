<x-layouts.app welcome>
    <main class="welcome-screen">
        <img class="welcome-logo" src="{{ asset('images/Country_Quiz.png') }}" alt="Country Quiz logo">
        <section class="welcome-content">
            <h1>Country Quiz</h1>
            <p>Test your knowledge of Croatia, Sweden, and<br>the Netherlands</p>
            <div class="welcome-actions">
                <a class="welcome-button welcome-signup" href="{{ route('register') }}"><span>Sign up</span></a>
                <a class="welcome-button welcome-signin" href="{{ route('login') }}"><span>Sign in</span></a>
            </div>
        </section>
    </main>
</x-layouts.app>
