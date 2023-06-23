@if ($paginator->hasPages())
<nav class="oleez-pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <a class="previous disabled">&larr;</a>
    @else
        <a class="previous" href="{{ $paginator->previousPageUrl() }}">&larr;</a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <a class="disabled">{{ $element}}</a>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a class="active">{{ $page }}</a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a class="next" href="{{ $paginator->nextPageUrl() }}">&rarr;</a>
    @else
        <a class="next disabled">&rarr;</a>
    @endif
</nav>
@endif