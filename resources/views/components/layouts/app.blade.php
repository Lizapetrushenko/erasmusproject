<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Country Quiz' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="{{ ($profile ?? false) ? 'profile-page' : '' }}">
<button id="theme-toggle" class="theme-toggle" type="button" aria-label="Toggle dark mode">🌙</button>

<form method="POST" class="lang-switch" aria-label="Language switcher">
    @csrf
    @foreach (['en' => 'EN', 'hr' => 'HR', 'nl' => 'NL'] as $code => $label)
        <button type="submit" formaction="{{ route('locale.switch', $code) }}" class="{{ app()->getLocale() === $code ? 'active' : '' }}">{{ $label }}</button>
    @endforeach
</form>

<div class="site">
    @if($game ?? false)
        <header class="game-topbar">
            <a class="game-brand" href="{{ auth()->check() ? route('dashboard') : route('home') }}"><img src="{{ asset('images/Country_Quiz.png') }}" alt="Country Quiz logo"><span>Country Quiz</span></a>
            @auth
                <div class="game-score">{{ __('Your scores:') }} <strong>{{ auth()->user()->totalScore() }}</strong></div>
                @php($remainingLives = min(3, max(0, request()->integer('lives', 3))))
                <div class="game-hearts" aria-label="{{ $remainingLives }} lives remaining">
                    @for ($heart = 1; $heart <= 3; $heart++)
                        <span class="heart {{ $heart <= $remainingLives ? 'heart-live' : 'heart-lost' }}">♥</span>
                    @endfor
                </div>
                <a class="game-profile profile-icon-link" href="{{ route('profile') }}" aria-label="{{ __('Profile') }}" title="{{ __('Profile') }}">
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
    @elseif($welcome ?? false)
    @else
        <header class="topbar">
            <a class="brand" href="{{ auth()->check() ? route('dashboard') : route('home') }}"><img class="brand-logo" src="{{ asset('images/Country_Quiz.png') }}" alt="Country Quiz logo"><span>Country Quiz</span></a>
            @auth
                <nav class="nav" aria-label="Main navigation">
                    <a href="{{ route('game') }}">{{ __('Play') }}</a>
                    <a href="{{ route('leaderboard') }}">{{ __('Leaderboard') }}</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.questions.index') }}">{{ __('Admin') }}</a>
                    @endif
                    <a href="{{ route('profile') }}" aria-label="{{ __('Profile') }}" title="{{ __('Profile') }}" class="profile-icon-link">
                        <i class="fa-solid fa-user" aria-hidden="true"></i>
                    </a>
                </nav>
            @endauth
            @guest
                <nav class="nav" aria-label="Main navigation">
                    <a class="nav-button" href="{{ route('login') }}">{{ __('Sign in') }}</a>
                </nav>
            @endguest
        </header>
    @endif
    {{ $slot }}
</div>
</body>
</html>
