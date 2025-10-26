@props([
    'active' => false
])

@php
    $classes = ($active ?? false) ? 'hover:text-primary text-primary' : 'hover:text-primary';
@endphp

<li class="text-slate-600 text-sm my-1">
    <a {{ $attributes->merge([ 'class' =>$classes]) }} wire:navigate>
        {{ $slot }}
    </a>
</li>
