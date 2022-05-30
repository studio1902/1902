<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center gap-4">
            <span>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="md:w-32 opacity-20 inline-flex justify-between items-center leading-none uppercase tracking-widest text-xs no-underline font-light md:whitespace-nowrap text-primary px-4 py-3 select-none bg-white cursor-default">
                        <svg class="w-4 h-4 fill-current rotate-180" viewBox="0 0 34 22"><path d="M23.613.21l.094.083 10 10c.029.028.055.059.08.09l-.08-.09a1.008 1.008 0 01.292.675L34 11v.033l-.004.052L34 11a1.008 1.008 0 01-.22.625l-.073.082-10 10a1 1 0 01-1.497-1.32l.083-.094L30.585 12H1a1 1 0 01-.117-1.993L1 10h29.585l-8.292-8.293a1 1 0 01-.083-1.32l.083-.094a1 1 0 011.32-.083z"/></svg>
                        <span>{!! __('strings.previous') !!}</span>
                    </span>
                @else
                    <button wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="md:w-32 inline-flex justify-between items-center leading-none uppercase tracking-widest text-xs no-underline font-light select-none md:whitespace-nowrap text-primary px-4 py-3 bg-white hover:bg-primary motion-safe:transition">
                        <svg class="w-4 h-4 fill-current rotate-180" viewBox="0 0 34 22"><path d="M23.613.21l.094.083 10 10c.029.028.055.059.08.09l-.08-.09a1.008 1.008 0 01.292.675L34 11v.033l-.004.052L34 11a1.008 1.008 0 01-.22.625l-.073.082-10 10a1 1 0 01-1.497-1.32l.083-.094L30.585 12H1a1 1 0 01-.117-1.993L1 10h29.585l-8.292-8.293a1 1 0 01-.083-1.32l.083-.094a1 1 0 011.32-.083z"/></svg>
                        <span>{!! __('strings.previous') !!}</span>
                    </button>
                @endif
            </span>

            <span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="md:w-32 inline-flex justify-between items-center leading-none uppercase tracking-widest text-xs no-underline font-light select-none md:whitespace-nowrap text-primary px-4 py-3 bg-white hover:bg-primary motion-safe:transition">
                        <span>{!! __('strings.next') !!}</span>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 34 22"><path d="M23.613.21l.094.083 10 10c.029.028.055.059.08.09l-.08-.09a1.008 1.008 0 01.292.675L34 11v.033l-.004.052L34 11a1.008 1.008 0 01-.22.625l-.073.082-10 10a1 1 0 01-1.497-1.32l.083-.094L30.585 12H1a1 1 0 01-.117-1.993L1 10h29.585l-8.292-8.293a1 1 0 01-.083-1.32l.083-.094a1 1 0 011.32-.083z"/></svg>
                    </button>
                @else
                    <span class="md:w-32 opacity-20 inline-flex justify-between items-center leading-none uppercase tracking-widest text-xs no-underline font-light select-none md:whitespace-nowrap text-primary px-4 py-3 bg-white cursor-default">
                        <span>{!! __('strings.next') !!}</span>
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 34 22"><path d="M23.613.21l.094.083 10 10c.029.028.055.059.08.09l-.08-.09a1.008 1.008 0 01.292.675L34 11v.033l-.004.052L34 11a1.008 1.008 0 01-.22.625l-.073.082-10 10a1 1 0 01-1.497-1.32l.083-.094L30.585 12H1a1 1 0 01-.117-1.993L1 10h29.585l-8.292-8.293a1 1 0 01-.083-1.32l.083-.094a1 1 0 011.32-.083z"/></svg>
                    </span>
                @endif
            </span>
        </nav>
    @endif
</div>
