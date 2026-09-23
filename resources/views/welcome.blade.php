<x-layouts.app>
    <main class="welcome-screen">
        <section class="welcome-content">
            <h1>Country Quiz</h1>
            <p>Test your knowledge of Croatia, Sweden, and<br>the Netherlands</p>
            <div class="welcome-actions">
                <a class="welcome-button welcome-signup" href="{{ route('register') }}">Sign up</a>
                <a class="welcome-button welcome-signin" href="{{ route('login') }}">Sign in</a>
            </div>
        </section>
    </main>
</x-layouts.app>
