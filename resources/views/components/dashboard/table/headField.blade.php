@props([
    'name' => ''
])

<th scope="col" class="p-3">
    {{ $name }}
    {{ $slot }}
</th>
