@props([
    'title' => '',
    'icon' => '',
    'active' => false,
])

@php
    $classes =
        ($active ?? false)
            ? 'flex items-center p-2 text-gray-900 rounded-lg my-1 hover:bg-gray-100 group bg-gray-200'
            : 'flex items-center p-2 text-gray-900 rounded-lg my-1 hover:bg-gray-100 group';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }} wire:navigate>
        <i class="{{ $icon }}"></i>
        <span class="ms-3">{{ $title }}</span>
    </a>

</li>
