<x-layouts.app minimal>
    <main class="container auth-wrap">
        <section class="auth-card signin-card">
            <h1>{{ __('Forgot your password?') }}</h1>
            <p class="auth-copy">{{ __("Enter your email and we'll send you a password reset link.") }}</p>
            @if (session('status'))
                <p class="form-success">{{ session('status') }}</p>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <label class="field">{{ __('Email:') }}<input type="email" name="email" value="{{ old('email') }}" required autofocus></label>
                @error('email') <p class="form-error">{{ $message }}</p> @enderror
                <button class="button" type="submit">{{ __('Send reset link') }}</button>
            </form>
            <a class="auth-link" href="{{ route('login') }}">{{ __('Back to sign in') }}</a>
        </section>
    </main>
</x-layouts.app>
