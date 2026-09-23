<x-layouts.app minimal>
    <main class="container auth-wrap">
        <section class="auth-card signin-card">
            <h1>Set a new password</h1>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <label class="field">Email:<input type="email" name="email" value="{{ old('email', $email) }}" required autofocus></label>
                @error('email') <p class="form-error">{{ $message }}</p> @enderror
                <label class="field">New Password:<input type="password" name="password" required></label>
                @error('password') <p class="form-error">{{ $message }}</p> @enderror
                <label class="field">Rewrite New Password:<input type="password" name="password_confirmation" required></label>
                <button class="button" type="submit">Save new password</button>
            </form>
            <a class="auth-link" href="{{ route('login') }}">Back to sign in</a>
        </section>
    </main>
</x-layouts.app>
