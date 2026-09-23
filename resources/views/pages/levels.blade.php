<x-layouts.app game>
    <main class="levels-screen">
        <h1>{{ __('Choose level') }}</h1>
        <div class="level-choices" role="group" aria-label="Choose quiz difficulty">
            <a class="level-choice level-easy" href="{{ route('countries') }}?difficulty=easy">{{ __('Easy') }}</a>
            <a class="level-choice level-medium" href="{{ route('countries') }}?difficulty=medium">{{ __('Medium') }}</a>
            <a class="level-choice level-hard" href="{{ route('countries') }}?difficulty=hard">{{ __('Hard') }}</a>
        </div>
    </main>
</x-layouts.app>