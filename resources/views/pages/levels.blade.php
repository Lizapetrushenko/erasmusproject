<x-layouts.app game>
    <main class="levels-screen">
        <h1>Choose level</h1>
        <div class="level-choices" role="group" aria-label="Choose quiz difficulty">
            <a class="level-choice level-easy" href="{{ route('countries') }}?difficulty=easy">Easy</a>
            <a class="level-choice level-medium" href="{{ route('countries') }}?difficulty=medium">Medium</a>
            <a class="level-choice level-hard" href="{{ route('countries') }}?difficulty=hard">Hard</a>
        </div>
    </main>
</x-layouts.app>