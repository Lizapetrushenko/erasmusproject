<x-layouts.app minimal title="Add question">
    <main class="container admin-screen admin-form-page" style="padding: 24px 0; max-width: 650px;">
        <div class="admin-form-heading">
            <h2>{{ __('Add question') }}</h2>
            <a class="admin-filter-reset" href="{{ route('admin.questions.index') }}">{{ __('Back to questions') }}</a>
        </div>
        <form class="admin-question-form" method="POST" action="{{ route('admin.questions.store') }}">
            @csrf
            @include('admin.questions._form')
        </form>
    </main>
</x-layouts.app>
