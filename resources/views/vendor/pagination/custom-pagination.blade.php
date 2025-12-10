@if ($paginator->hasPages())
<nav>
    <ul class="pagination justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">Previous</span></li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a>
            </li>
        @endif

        {{-- First Page --}}
        @if ($paginator->currentPage() > 3)
            <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
            @if ($paginator->currentPage() > 4)
                <li class="page-item disabled"><span class="page-link">…</span></li>
            @endif
        @endif

        {{-- Pagination Elements (2 before & 2 after) --}}
        @foreach (range(max($paginator->currentPage() - 2, 1), min($paginator->currentPage() + 2, $paginator->lastPage())) as $page)
            <li class="page-item {{ $page == $paginator->currentPage() ? 'active bg-success text-white' : '' }}">
                <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
            </li>
        @endforeach

        {{-- Last Page --}}
        @if ($paginator->currentPage() < $paginator->lastPage() - 2)
            @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                <li class="page-item disabled"><span class="page-link">…</span></li>
            @endif
            <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a>
            </li>
        @else
            <li class="page-item disabled"><span class="page-link">Next</span></li>
        @endif
    </ul>
</nav>
@endif
