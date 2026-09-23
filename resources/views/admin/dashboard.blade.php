<x-layouts.app game>
    <main class="admin-screen admin-dashboard">
        <header class="admin-hero">
            <div class="admin-hero-copy">
                <span class="admin-kicker"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i> {{ __('Administration') }}</span>
                <h1>{{ __('Admin dashboard') }}</h1>
                <p>{{ __('Monitor your quiz and manage the question bank.') }}</p>
            </div>
            <div class="admin-dashboard-actions">
                <a class="admin-action-secondary" href="{{ route('admin.questions.index') }}"><i class="fa-solid fa-list-check" aria-hidden="true"></i> {{ __('Manage questions') }}</a>
                <a class="admin-action-primary" href="{{ route('admin.questions.create') }}"><i class="fa-solid fa-plus" aria-hidden="true"></i> {{ __('Add question') }}</a>
            </div>
        </header>

        <section class="admin-stats" aria-label="{{ __('Project overview') }}">
            <article class="admin-stat-card stat-users">
                <span class="admin-stat-icon"><i class="fa-solid fa-users" aria-hidden="true"></i></span>
                <div><p>{{ __('Users') }}</p><strong>{{ number_format($usersCount) }}</strong><small>{{ __('Registered accounts') }}</small></div>
            </article>
            <article class="admin-stat-card stat-questions">
                <span class="admin-stat-icon"><i class="fa-solid fa-circle-question" aria-hidden="true"></i></span>
                <div><p>{{ __('Questions') }}</p><strong>{{ number_format($questionsCount) }}</strong><small>{{ __('In the question bank') }}</small></div>
            </article>
            <article class="admin-stat-card stat-results">
                <span class="admin-stat-icon"><i class="fa-solid fa-chart-column" aria-hidden="true"></i></span>
                <div><p>{{ __('Completed quizzes') }}</p><strong>{{ number_format($resultsCount) }}</strong><small>{{ __('Saved quiz results') }}</small></div>
            </article>
        </section>

        <section class="admin-activity-card">
            <header class="admin-section-heading">
                <div><span class="admin-section-kicker">{{ __('User activity') }}</span><h2>{{ __('Recent quiz activity') }}</h2></div>
                <span class="admin-live-mark"><i aria-hidden="true"></i> {{ __('Latest results') }}</span>
            </header>
            <div class="admin-activity-list">
                @forelse ($recentResults as $result)
                    <article class="admin-activity-row">
                        <span class="admin-user-avatar">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($result->user?->name ?? '?', 0, 1)) }}</span>
                        <div class="admin-activity-user">
                            <strong>{{ $result->user?->name ?? __('Deleted user') }}</strong>
                            <small>{{ $result->correct_answers }} {{ __('correct answers') }} · {{ $result->remaining_lives }} {{ __('lives left') }}</small>
                        </div>
                        <time datetime="{{ $result->date->toDateString() }}">{{ $result->date->format('d M Y') }}</time>
                        <strong class="admin-activity-score">{{ number_format($result->score) }} <small>{{ __('points') }}</small></strong>
                    </article>
                @empty
                    <div class="admin-activity-empty">
                        <i class="fa-solid fa-chart-line" aria-hidden="true"></i>
                        <p>{{ __('No quiz results yet.') }}</p>
                    </div>
                @endforelse
            </div>
            <footer class="admin-activity-pagination">
                <span>{{ __('Showing latest activity') }}</span>
                @include('components.pagination', ['paginator' => $recentResults])
            </footer>
        </section>
    </main>
</x-layouts.app>
