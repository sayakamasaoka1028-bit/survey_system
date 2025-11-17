@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center space-x-1 my-4 text-sm">
    {{-- 前へボタン --}}
    @if ($paginator->onFirstPage())
        <span class="px-3 py-1 rounded bg-gray-200 text-gray-500 cursor-not-allowed">&laquo;</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 rounded bg-gray-100 hover:bg-gray-200">&laquo;</a>
    @endif

    {{-- ページ番号 --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="px-3 py-1">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="px-3 py-1 rounded bg-blue-500 text-white">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-3 py-1 rounded bg-gray-100 hover:bg-gray-200">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- 次へボタン --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 rounded bg-gray-100 hover:bg-gray-200">&raquo;</a>
    @else
        <span class="px-3 py-1 rounded bg-gray-200 text-gray-500 cursor-not-allowed">&raquo;</span>
    @endif
</nav>
@endif
