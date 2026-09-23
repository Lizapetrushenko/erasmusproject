<x-layouts.app minimal>
    <main class="container auth-wrap">
        <section class="auth-card signup-card">
            <h1>{{ __('Sign up') }}</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <label class="field">{{ __('Name:') }}<input type="text" name="name" required></label>
                <label class="field">{{ __('Email address:') }}<input type="email" name="email" required></label>
                <label class="field">{{ __('Password:') }}<input type="password" name="password" required></label>
                <label class="field">{{ __('Control your password:') }}<input type="password" name="password_confirmation" required></label>
                <button class="button" type="submit">{{ __('Sign up') }}</button>
            </form>
        </section>
    </main>
</x-layouts.app>
