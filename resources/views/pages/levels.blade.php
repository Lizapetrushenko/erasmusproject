<x-layouts.app game>
    <main class="levels-screen">
        <h1>{{ __('Choose level') }}</h1>
        @php($userLevel = auth()->user()->level())
        <p class="subtle level-current">{{ __('Your level:') }} {{ \App\Support\Level::label($userLevel) }}</p>
        <div class="level-choices" role="group" aria-label="Choose quiz difficulty">
            @foreach (['easy' => ['Easy', 'level-easy'], 'medium' => ['Medium', 'level-medium'], 'hard' => ['Hard', 'level-hard']] as $difficulty => [$label, $class])
                @if (\App\Support\Level::unlocksDifficulty($userLevel, $difficulty))
                    <a class="level-choice {{ $class }}" href="{{ route('countries') }}?difficulty={{ $difficulty }}">{{ __($label) }}</a>
                @else
                    <div class="level-choice level-locked {{ $class }}" aria-disabled="true">
                        {{ __($label) }}<small>{{ __('Unlock at :level', ['level' => $difficulty === 'medium' ? 'Pro' : 'Expert']) }}</small>
                    </div>
                @endif
            @endforeach
        </div>
    </main>
</x-layouts.app>
