<x-layouts.app minimal title="Edit question">
    <main class="container" style="padding: 24px 0; max-width: 560px;">
        <h2>{{ __('Edit question') }}</h2>
        <form method="POST" action="{{ route('admin.questions.update', $question) }}">
            @csrf
            @method('PUT')
            @include('admin.questions._form')
        </form>
    </main>
</x-layouts.app>
