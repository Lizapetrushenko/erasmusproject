<x-layouts.app game>
    <main class="container">
        <section class="panel" id="choose-level" style="margin-top: 24px;">
            <h2>{{ __('Choose your level') }}</h2>
            <p class="subtle">{{ __('Pick a difficulty and a country to start the quiz.') }}</p>
            <div class="levels">
                <div class="level">{{ __('Easy') }}</div>
                <div class="level">{{ __('Medium') }}</div>
                <div class="level">{{ __('Hard') }}</div>
            </div>
            <div class="countries">
                <div class="country">🇭🇷 {{ __('Croatia') }}</div>
                <div class="country">🇸🇪 {{ __('Sweden') }}</div>
                <div class="country">🇳🇱 {{ __('Netherlands') }}</div>
            </div>
        </section>
    </main>
</x-layouts.app>
