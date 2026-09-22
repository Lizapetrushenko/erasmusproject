<x-layouts.app minimal>
    <main class="container auth-wrap">
        <section class="auth-card signin-card">
            <h1>Reset password</h1>
            <p class="auth-copy">Enter your email and choose a new password.</p>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <label class="field">Email:<input type="email" name="email" value="{{ old('email') }}" required autofocus></label>
                @error('email') <p class="form-error">{{ $message }}</p> @enderror
                <label class="field">New Password:<input type="password" name="password" required></label>
                @error('password') <p class="form-error">{{ $message }}</p> @enderror
                <label class="field">Repeat New Password:<input type="password" name="password_confirmation" required></label>
                <button class="button" type="submit">Reset password</button>
            </form>
            <a class="auth-link" href="{{ route('login') }}">Back to sign in</a>
        </section>
    </main>
</x-layouts.app>
