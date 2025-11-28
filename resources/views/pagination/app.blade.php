@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <div>
            @if ($paginator->firstItem() !== null)
                <span style="font-size: 0.85rem; color: var(--text-muted)">
                    Showing
                    <span style="font-weight: 600; color: var(--text-dark)">
                        {{ $paginator->firstItem() }}
                    </span>
                    to
                    <span style="font-weight: 600; color: var(--text-dark)">
                        {{ $paginator->lastItem() }}
                    </span>
                    of
                    <span style="font-weight: 600; color: var(--text-dark)">
                        {{ $paginator->total() }}
                    </span>
                    results
                </span>
            @endif
        </div>

        <div>
            <span class="relative z-0 inline-flex rounded-full shadow-sm">
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="&laquo; Sebelumnya">
                        <span
                            class="relative inline-flex cursor-default items-center justify-center text-xs font-medium">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.293 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L8.414 10l3.879 3.879a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        class="relative inline-flex items-center justify-center text-xs font-medium"
                        aria-label="&laquo; Sebelumnya">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.293 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L8.414 10l3.879 3.879a1 1 0 010 1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span aria-disabled="true"
                            class="relative inline-flex cursor-default items-center justify-center text-xs font-medium">
                            {{ $element }}
                        </span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page"
                                    class="relative inline-flex items-center justify-center text-xs">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="relative inline-flex items-center justify-center text-xs">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="relative inline-flex items-center justify-center text-xs font-medium"
                        aria-label="Berikutnya &raquo;">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M7.707 4.293a1 1 0 010 1.414L12.293 10l-4.586 4.293a1 1 0 001.414 1.414l5-5a1 1 0 000-1.414l-5-5a1 1 0 00-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span aria-disabled="true" aria-label="Berikutnya &raquo;">
                        <span
                            class="relative inline-flex cursor-default items-center justify-center text-xs font-medium">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M7.707 4.293a1 1 0 010 1.414L12.293 10l-4.586 4.293a1 1 0 001.414 1.414l5-5a1 1 0 000-1.414l-5-5a1 1 0 00-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                @endif
            </span>
        </div>

        <div></div>
    </nav>
@endif
