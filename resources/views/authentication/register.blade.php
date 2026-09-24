<x-layouts.app minimal>

    <main class="container auth-wrap">

        <form method="POST" action="{{ route('register.store') }}" class="auth-page">
            @csrf

            <section class="auth-card signup-card">

                <h1>{{ __('Sign up') }}</h1>

                <label class="field">
                    {{ __('Name:') }}
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                    >
                </label>

                @error('name')
                    <p class="form-error">
                        {{ $message }}
                    </p>
                @enderror

                <label class="field">
                    {{ __('Email address:') }}
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
                    {{ __('Password:') }}
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

                <label class="field">
                    {{ __('Confirm password:') }}
                    <input
                        type="password"
                        name="password_confirmation"
                        required
                    >
                </label>

                @error('password_confirmation')
                    <p class="form-error">
                        {{ $message }}
                    </p>
                @enderror


                <div class="signup-actions">

                    <a
                        class="auth-text-link"
                        href="{{ route('login') }}"
                    >
                        {{ __('Already have an account? Sign in') }}
                    </a>

                </div>


                <div class="auth-submit-wrap">
                    <button
                        class="button auth-submit"
                        type="submit"
                    >
                        {{ __('Sign up') }}
                    </button>
                </div>

            </section>

        </form>

    </main>

</x-layouts.app>
