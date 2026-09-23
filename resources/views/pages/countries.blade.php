<x-layouts.app game>
    <main class="countries-screen">
        <h1>Choose country</h1>
        <div class="country-choices" role="group" aria-label="Choose a country">
            <a class="country-choice country-croatia" href="{{ route('game') }}?country=Croatia&difficulty={{ request('difficulty', 'easy') }}"><img class="country-flag" src="{{ asset('images/croatia.png') }}" alt=""><span>Croatia</span></a>
            <a class="country-choice country-netherlands" href="{{ route('game') }}?country=Netherlands&difficulty={{ request('difficulty', 'easy') }}"><img class="country-flag" src="{{ asset('images/netherland.png') }}" alt=""><span>The Netherlands</span></a>
            <a class="country-choice country-sweden" href="{{ route('game') }}?country=Sweden&difficulty={{ request('difficulty', 'easy') }}"><img class="country-flag" src="{{ asset('images/sweden.png') }}" alt=""><span>Sweden</span></a>
        </div>
    </main>
</x-layouts.app>