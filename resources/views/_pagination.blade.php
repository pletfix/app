@if ($paginator->hasMultiplePages())
    <ul class="pagination">
        @if ($url = $paginator->previousUrl())
            <li><a href="{{$url}}" title="previous"><span>&laquo;</span></a></li>
        @else
            <li class="disabled"><span>&laquo;</span></li>
        @endif
        @foreach ($paginator->pages() as $page)
            @if($page == '...')
                <li class="disabled"><span>...</span></li>
            @elseif ($page == $paginator->currentPage())
                <li class="active"><span>{{$page}}</span></li>
            @else
                <li><a href="{{$paginator->url($page)}}">{{$page}}</a></li>
            @endif
        @endforeach
        @if ($url = $paginator->nextUrl())
            <li><a href="{{$url}}" title="next"><span>&raquo;</span></a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
@endif