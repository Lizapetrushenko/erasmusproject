@if ($paginator->hasPages())
    <nav class="compact-pagination" aria-label="{{ __('Page navigation') }}">
        @if ($paginator->onFirstPage())
            <span class="is-disabled" aria-disabled="true">← {{ __('Previous') }}</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">← {{ __('Previous') }}</a>
        @endif

        <span class="pagination-count">{{ __('Page :current of :last', ['current' => $paginator->currentPage(), 'last' => $paginator->lastPage()]) }}</span>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">{{ __('Next') }} →</a>
        @else
            <span class="is-disabled" aria-disabled="true">{{ __('Next') }} →</span>
        @endif
    </nav>
@endif
