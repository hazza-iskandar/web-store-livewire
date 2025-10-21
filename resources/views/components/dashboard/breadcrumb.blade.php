@props([
    'title' => '',
    'items' => [],
])

<div class="mb-6">
    <h1 class="text-2xl sm:text-3xl font-semibold text-gray-800 mb-2">{{ $title }}</h1>
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <!-- Home -->
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary">
                    <i class="fas fa-home w-3 h-3 me-2.5"></i>
                    Dashboard
                </a>
            </li>

            @foreach ($items as $key => $item)
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-1 text-xs"></i>

                        @if ($loop->last)
                            <span
                                class="ms-1 text-sm font-medium text-gray-700 hover:text-primary md:ms-2">{{ $item['name'] }}</span>
                        @else
                            <a href="{{ $item['url'] ?? '#' }}"
                                class="ms-1 text-sm font-medium text-gray-700 hover:text-primary md:ms-2">{{ $item['name'] }}</a>
                        @endif
                    </div>
                </li>
            @endforeach
        </ol>
    </nav>

</div>
