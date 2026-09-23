<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Country Quiz' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="site">
    @if($game ?? false)
        <header class="game-topbar">
            <a class="game-brand" href="{{ auth()->check() ? route('dashboard') : route('home') }}"><img src="{{ asset('images/Country_Quiz.png') }}" alt="Country Quiz logo"><span>Country Quiz</span></a>
            @auth
                <div class="game-score">Your scores: <strong>{{ auth()->user()->score ?? 0 }}</strong></div>
                @php($remainingLives = min(3, max(0, request()->integer('lives', auth()->user()->lives ?? 3))))
                <div class="game-hearts" aria-label="{{ $remainingLives }} lives remaining">
                    @for ($heart = 1; $heart <= 3; $heart++)
                        <span class="heart {{ $heart <= $remainingLives ? 'heart-live' : 'heart-lost' }}">♥</span>
                    @endfor
                </div>
                <form method="POST" class="header-language-form" aria-label="Language selector">
                    @csrf
                    <select name="locale" aria-label="Language" onchange="this.form.action='{{ url('/locale') }}/' + this.value; this.form.submit()">
                        @foreach (['en' => 'EN', 'hr' => 'HR', 'nl' => 'NL'] as $code => $label)
                            <option value="{{ $code }}" @selected(app()->getLocale() === $code)>{{ $label }}</option>
                        @endforeach
                    </select>
                </form>
                    <button id="theme-toggle" class="theme-toggle game-theme-toggle" type="button" aria-label="Toggle dark mode"></button>
                <a class="game-profile profile-icon-link" href="{{ route('profile') }}" aria-label="Profile" title="Profile">
                    <i class="fa-solid fa-user" aria-hidden="true"></i>
                </a>
            @endauth
        </header>
    @elseif($minimal ?? false)
        <header class="topbar minimal-topbar">
            <a class="brand" href="{{ auth()->check() ? route('dashboard') : route('home') }}"><img class="brand-logo" src="{{ asset('images/Country_Quiz.png') }}" alt="Country Quiz logo"><span>Country Quiz</span></a>
            <form method="POST" class="header-language-form" aria-label="Language selector">
                @csrf
                <select name="locale" aria-label="Language" onchange="this.form.action='{{ url('/locale') }}/' + this.value; this.form.submit()">
                    @foreach (['en' => 'EN', 'hr' => 'HR', 'nl' => 'NL'] as $code => $label)
                        <option value="{{ $code }}" @selected(app()->getLocale() === $code)>{{ $label }}</option>
                    @endforeach
                </select>
            </form>
        </header>
    @else
        <header class="topbar">
            <a class="brand" href="{{ auth()->check() ? route('dashboard') : route('home') }}"><img class="brand-logo" src="{{ asset('images/Country_Quiz.png') }}" alt="Country Quiz logo"><span>Country Quiz</span></a>
            <nav class="nav" aria-label="Main navigation">
                <a href="{{ route('game') }}">{{ __('Play') }}</a>
                <a href="{{ route('leaderboard') }}">{{ __('Leaderboard') }}</a>
                <form method="POST" class="header-language-form" aria-label="Language selector">
                    @csrf
                    <select name="locale" aria-label="Language" onchange="this.form.action='{{ url('/locale') }}/' + this.value; this.form.submit()">
                        @foreach (['en' => 'EN', 'hr' => 'HR', 'nl' => 'NL'] as $code => $label)
                            <option value="{{ $code }}" @selected(app()->getLocale() === $code)>{{ $label }}</option>
                        @endforeach
                    </select>
                </form>
                <a href="{{ route('profile') }}">{{ __('Profile') }}</a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.questions.index') }}">{{ __('Admin') }}</a>
                    @endif
                @endauth
                @guest
                    <a class="nav-button" href="{{ route('login') }}">{{ __('Sign in') }}</a>
                @endguest
            </nav>
        </header>
    @endif
    {{ $slot }}
</div>
</body>
</html>
