@if ($paginator->hasPages())
    <ul class="pagination">
       
        @if (!$paginator->onFirstPage())
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination_arow prev mx-1">
                    <img src="/img/arow.png" alt="">
                </a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active pagination_link mx-1"><span>{{ $page }}</span></li>
                    @else
                        <li><a class="pagination_link mx-1" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination_arow mx-1"><img src="/img/arow.png" alt=""></a>
            </li>
        @endif
    </ul>
@endif 