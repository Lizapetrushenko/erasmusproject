<x-layouts.app minimal>
    <main class="container auth-wrap">
        <section class="auth-card signin-card">
            <h1>Sign in</h1>
            @if (session('status'))
                <p class="form-success">{{ session('status') }}</p>
            @endif
            <form method="POST" action="{{ route('login.store') }}">
                @csrf
                <label class="field">Email:<input type="email" name="email" value="{{ old('email') }}" required></label>
                @error('email') <p class="form-error">{{ $message }}</p> @enderror
                <label class="field">Password:<input type="password" name="password" required></label>
                @error('password') <p class="form-error">{{ $message }}</p> @enderror
                <a class="auth-link" href="{{ route('password.request') }}">Forgot password?</a>
                <button class="button" type="submit">Sign in</button>
            </form>
        </section>
    </main>
</x-layouts.app>
