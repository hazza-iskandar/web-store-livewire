@if ($paginator->hasPages())
    <div class="flex flex-col items-center mt-5">
        <!-- Help text -->
        <span class="text-sm text-gray-700 ">
            Showing <span class="font-semibold text-gray-900">{{ $paginator->firstItem() }}</span> to <span
                class="font-semibold text-gray-900">{{ $paginator->lastItem() }}</span>
            of <span class="font-semibold text-gray-900">{{ $paginator->total() }}</span>
            Entries
        </span>
        <!-- Buttons -->
        <div class="inline-flex mt-2 xs:mt-0">
            @if ($paginator->onFirstPage())
                <button disabled
                    class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-500 rounded-s cursor-not-allowed opacity-50">
                    Prev
                </button>
            @else
                <button wire:click="previousPage('{{ $paginator->getPageName() }}')"
                    class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-primary transition-all duration-500 rounded-s hover:bg-gray-900 cursor-pointer ">
                    Prev
                </button>
            @endif
            {{-- Next Page --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                    class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-primary transition-all duration-500 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 cursor-pointer">
                    Next
                </button>
            @else
                <button disabled
                    class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-500 border-0 border-s border-gray-700 rounded-e cursor-not-allowed opacity-50">
                    Next
                </button>
            @endif
        </div>
    </div>
@endif
