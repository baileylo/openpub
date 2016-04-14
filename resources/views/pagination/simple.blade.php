<div class="row hidden-for-small-down">
    <div class="columns large-6 medium-6">
        @if ($paginator->currentPage() !== 1)
            <a rel="prev" href="{{ $paginator->previousPageUrl() }}" class="button ">Newer</a>
        @endif
    </div>

    <div class="columns large-6 medium-6 text-right">
        @if ($paginator->hasMorePages())
            <a rel="next" href="{{ $paginator->nextPageUrl() }}" class="button Older">Older</a>
        @endif
    </div>
</div>

<div class="row visible-for-small-down">
    <div class="columns small-6">
        @if ($paginator->currentPage() !== 1)
            <a rel="prev" href="{{ $paginator->previousPageUrl() }}" class="button expand">Newer</a>
        @endif
    </div>

    <div class="columns small-6">
        @if ($paginator->hasMorePages())
            <a rel="next" href="{{ $paginator->nextPageUrl() }}" class="button Older">Older</a>
        @endif
    </div>
</div>