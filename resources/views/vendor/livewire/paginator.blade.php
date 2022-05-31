@if ($paginator->hasPages())
    <div>
        @php $active_classes = "p-1 -m-1 rounded flex space-x-1 items-baseline font-medium text-neutral dark:text-white focus:outline-none focus-visible:ring ring-primary dark:ring-secondary leading-none underline underline-offset-4 decoration-dotted decoration-2 decoration-primary dark:decoration-secondary hover:text-primary hover:dark:text-secondary motion-safe:transition cursor-pointer" @endphp
        @php $inactive_classes = "flex space-x-1 items-baseline font-medium text-neutral dark:text-white opacity-30 leading-none underline underline-offset-4 decoration-dotted decoration-2 decoration-neutral dark:decoration-white" @endphp
        @php $location_classes = "text-sm font-medium text-neutral dark:text-white" @endphp

        <nav aria-label="Pagination" class="md:px-8 flex justify-center items-baseline space-x-8">
            @if ($paginator->onFirstPage())
                <span class="{{ $inactive_classes }}">{!! __('strings.previous') !!}</span>
            @else
                <button class="{{ $active_classes }}" wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}">{!! __('strings.previous') !!}</button>
            @endif

            @if ($paginator->hasMorePages())
                <button class="{{ $active_classes }}" wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}">{!! __('strings.next') !!}</button>
            @else
                <span class="{{ $inactive_classes }}">{!! __('strings.next') !!}</span>
            @endif
        </nav>
    </div>
@endif
