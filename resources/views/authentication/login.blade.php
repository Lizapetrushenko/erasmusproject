<x-layouts.app minimal>
    <main class="container auth-wrap">
        <section class="auth-card signin-card">
            <h1>{{ __('Sign in') }}</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label class="field">{{ __('Email address:') }}<input type="email" name="email" required></label>
                <label class="field">{{ __('Password:') }}<input type="password" name="password" required></label>
                <button class="button" type="submit">{{ __('Sign in') }}</button>
            </form>
        </section>
    </main>
</x-layouts.app>
