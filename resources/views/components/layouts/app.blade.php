<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Country Quiz' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<button id="theme-toggle" class="theme-toggle" type="button" aria-label="Toggle dark mode">🌙</button>

<form method="POST" class="lang-switch" aria-label="Language switcher">
    @csrf
    @foreach (['en' => 'EN', 'hr' => 'HR', 'nl' => 'NL'] as $code => $label)
        <button type="submit" formaction="{{ route('locale.switch', $code) }}" class="{{ app()->getLocale() === $code ? 'active' : '' }}">{{ $label }}</button>
    @endforeach
</form>

<div class="site">
    @if($welcome ?? false)
    @elseif($game ?? false)
        <header class="game-topbar">
            <a class="game-brand" href="{{ route('home') }}"><img src="{{ asset('images/Country_Quiz.png') }}" alt="Country Quiz logo"><span>Country Quiz</span></a>
            <div class="game-score">{{ __('Your scores:') }} <strong>{{ auth()->user()?->totalScore() ?? 0 }}</strong></div>
            @php($remainingLives = min(3, max(0, request()->integer('lives', 3))))
            <div class="game-hearts" aria-label="{{ $remainingLives }} lives remaining">
                @for ($heart = 1; $heart <= 3; $heart++)
                    <span class="heart {{ $heart <= $remainingLives ? 'heart-live' : 'heart-lost' }}">♥</span>
                @endfor
            </div>
            <a class="game-profile" href="{{ route('profile') }}" aria-label="Profile">♙</a>
        </header>
    @elseif($minimal ?? false)
        <header class="topbar minimal-topbar">
            <a class="brand" href="{{ route('home') }}"><img class="brand-logo" src="{{ asset('images/Country_Quiz.png') }}" alt="Country Quiz logo"><span>Country Quiz</span></a>
        </header>
    @else
        <header class="topbar">
            <a class="brand" href="{{ route('home') }}"><img class="brand-logo" src="{{ asset('images/Country_Quiz.png') }}" alt="Country Quiz logo"><span>Country Quiz</span></a>
            <nav class="nav" aria-label="Main navigation">
                <a href="{{ route('game') }}">{{ __('Play') }}</a>
                <a href="{{ route('leaderboard') }}">{{ __('Leaderboard') }}</a>
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
