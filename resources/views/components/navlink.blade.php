@props(['active' => false])

@php
    $classes = ($active ?? false) ? 'active ' : 'nav-link';
@endphp
<li> 
     <a {{ $attributes->merge(['class' => $classes]) }} wire:navigate>{{ $slot }}</a>
 </li>

