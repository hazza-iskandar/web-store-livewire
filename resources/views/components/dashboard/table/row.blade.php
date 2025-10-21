@props([
    'class' => '',
    'colspan' => null,
])

{{-- jika tidak ada class di masukan maka guankan default class --}}
<td {{ $attributes->merge(['class' => $class ?: 'w-75 p-3', 'colspan' => $colspan]) }}>
    {{ $slot }}
</td>
