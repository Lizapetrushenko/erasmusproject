<x-layouts.app minimal title="Add question">
    <main class="container" style="padding: 24px 0; max-width: 560px;">
        <h2>{{ __('Add question') }}</h2>
        <form method="POST" action="{{ route('admin.questions.store') }}">
            @csrf
            @include('admin.questions._form')
        </form>
    </main>
</x-layouts.app>
