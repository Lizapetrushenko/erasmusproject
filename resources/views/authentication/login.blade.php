<x-layouts.app minimal>

    <main class="container auth-wrap">

        <form method="POST" action="{{ route('login.store') }}" class="auth-page">
            @csrf

            <section class="auth-card signin-card">

                <h1>Sign in</h1>

                @if (session('status'))
                    <p class="form-success">
                        {{ session('status') }}
                    </p>
                @endif

                <label class="field">
                    Email:
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                    >
                </label>

                @error('email')
                    <p class="form-error">
                        {{ $message }}
                    </p>
                @enderror

                <label class="field">
                    Password:
                    <input
                        type="password"
                        name="password"
                        required
                    >
                </label>

                @error('password')
                    <p class="form-error">
                        {{ $message }}
                    </p>
                @enderror


                <div class="signin-actions">

                    <a
                        class="auth-text-link"
                        href="{{ route('password.request') }}"
                    >
                        Forgot password
                    </a>

                    <a
                        class="auth-text-link"
                        href="{{ route('register') }}"
                    >
                        No account? Sign up
                    </a>

                </div>


                <div class="auth-submit-wrap">
                    <button
                        class="button auth-submit"
                        type="submit"
                    >
                        Sign in
                    </button>
                </div>

            </section>

        </form>

    </main>

</x-layouts.app>