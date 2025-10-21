@props([
    'show' => '',
    'width' =>  ''
])

<div x-show="{{ $show }}" x-cloak
    class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-xs z-50" x-transition.opacity>
    <div @click.outside="{{ $show }} = false" x-transition.scale
        {{ $attributes->merge(['class' => 'bg-white p-3 rounded-lg shadow-lg text-center '. ($width ?:'w-96')]) }}>
        {{ $slot }}
    </div>
</div>
