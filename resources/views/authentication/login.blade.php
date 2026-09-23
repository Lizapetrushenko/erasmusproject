<x-layouts.app minimal>
    <main class="container auth-wrap">
        <section class="auth-card signin-card">
            <h1>Sign in</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label class="field">Username:<input type="text" name="username" required></label>
                <label class="field">Password:<input type="password" name="password" required></label>
                <button class="button" type="submit">Sign in</button>
            </form>
        </section>
    </main>
</x-layouts.app>
