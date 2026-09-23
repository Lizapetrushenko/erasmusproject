<x-layouts.app game>
    <main class="countries-screen">
        <h1>{{ __('Choose country') }}</h1>
        <div class="country-choices" role="group" aria-label="{{ __('Choose a country') }}">
            @foreach ([['Croatia', 'croatia.png', 'country-croatia'], ['Netherlands', 'netherland.png', 'country-netherlands'], ['Sweden', 'sweden.png', 'country-sweden']] as [$country, $image, $class])
                <form method="POST" action="{{ route('quiz.start') }}">
                    @csrf
                    <input type="hidden" name="country" value="{{ $country }}">
                    <input type="hidden" name="difficulty" value="{{ request('difficulty', 'easy') }}">
                    <button class="country-choice {{ $class }}" type="submit"><img class="country-flag" src="{{ asset('images/'.$image) }}" alt=""><span>{{ $country === 'Netherlands' ? __('The Netherlands') : __($country) }}</span></button>
                </form>
            @endforeach
        </div>
    </main>
</x-layouts.app>
