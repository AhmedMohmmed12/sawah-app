@if ($paginator->hasPages())
    <nav aria-label="Pages">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="is-disabled" aria-disabled="true"><span><x-icon name="chevron-left" size="sm" /></span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous page"><x-icon name="chevron-left" size="sm" /></a></li>
            @endif

            @isset($elements)
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="is-disabled"><span>{{ $element }}</span></li>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="is-current" aria-current="page"><span>{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endisset

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page"><x-icon name="chevron-right" size="sm" /></a></li>
            @else
                <li class="is-disabled" aria-disabled="true"><span><x-icon name="chevron-right" size="sm" /></span></li>
            @endif
        </ul>
        @if (method_exists($paginator, 'total'))
            <p class="pagination-info">{{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }}</p>
        @endif
    </nav>
@endif
