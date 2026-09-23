<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Country Quiz' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwUEQp1Dix8/WDq5eH4d3TjXw4xH9iKpX4e4W4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="site">
    <header class="topbar">
        <a class="brand" href="{{ route('home') }}"><img class="brand-logo" src="{{ asset('images/Country_Quiz.png') }}" alt="Country Quiz logo"><span>Country Quiz</span></a>
        <nav class="nav" aria-label="Main navigation">
            <a href="{{ route('game') }}">Play</a>
            <a href="{{ route('leaderboard') }}">Leaderboard</a>
            <a href="{{ route('profile') }}" aria-label="Profile" title="Profile" class="profile-icon-link">
                <i class="fa-solid fa-user" aria-hidden="true"></i>
            </a>
            <a class="nav-button" href="{{ route('login') }}">Sign in</a>
        </nav>
    </header>
    {{ $slot }}
</div>
</body>
</html>
