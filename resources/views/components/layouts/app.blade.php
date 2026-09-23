<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Country Quiz' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="site">
    @if($welcome ?? false)
    @elseif($game ?? false)
        <header class="game-topbar">
            <a class="game-brand" href="{{ route('home') }}"><img src="{{ asset('images/Country_Quiz.png') }}" alt="Country Quiz logo"><span>Country Quiz</span></a>
            @auth
                <div class="game-score">Your scores: <strong>{{ auth()->user()->score ?? 0 }}</strong></div>
                @php($remainingLives = min(3, max(0, request()->integer('lives', auth()->user()->lives ?? 3))))
                <div class="game-hearts" aria-label="{{ $remainingLives }} lives remaining">
                    @for ($heart = 1; $heart <= 3; $heart++)
                        <span class="heart {{ $heart <= $remainingLives ? 'heart-live' : 'heart-lost' }}">♥</span>
                    @endfor
                </div>
                <a class="game-profile profile-icon-link" href="{{ route('profile') }}" aria-label="Profile" title="Profile">
                    <i class="fa-solid fa-user" aria-hidden="true"></i>
                </a>
            @endauth
        </header>
    @elseif($minimal ?? false)
        <header class="topbar minimal-topbar">
            <a class="brand" href="{{ route('home') }}"><img class="brand-logo" src="{{ asset('images/Country_Quiz.png') }}" alt="Country Quiz logo"><span>Country Quiz</span></a>
        </header>
    @else
        <header class="topbar">
            <a class="brand" href="{{ route('home') }}"><img class="brand-logo" src="{{ asset('images/Country_Quiz.png') }}" alt="Country Quiz logo"><span>Country Quiz</span></a>
            @auth
                <nav class="nav" aria-label="Main navigation">
                    <a href="{{ route('game') }}">Play</a>
                    <a href="{{ route('leaderboard') }}">Leaderboard</a>
                    <a href="{{ route('profile') }}" aria-label="Profile" title="Profile" class="profile-icon-link">
                        <i class="fa-solid fa-user" aria-hidden="true"></i>
                    </a>
                </nav>
            @endauth
        </header>
    @endif
    {{ $slot }}
</div>
</body>
</html>
