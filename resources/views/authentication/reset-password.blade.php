<x-layouts.app minimal>
    <main class="container auth-wrap">
        <section class="auth-card signin-card">
            <h1>{{ __('Set a new password') }}</h1>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <label class="field">{{ __('Email:') }}<input type="email" name="email" value="{{ old('email', $email) }}" required autofocus></label>
                @error('email') <p class="form-error">{{ $message }}</p> @enderror
                <label class="field">{{ __('New Password:') }}<input type="password" name="password" required></label>
                @error('password') <p class="form-error">{{ $message }}</p> @enderror
                <label class="field">{{ __('Rewrite New Password:') }}<input type="password" name="password_confirmation" required></label>
                <button class="button" type="submit">{{ __('Save new password') }}</button>
            </form>
            <a class="auth-link" href="{{ route('login') }}">{{ __('Back to sign in') }}</a>
        </section>
    </main>
</x-layouts.app>
