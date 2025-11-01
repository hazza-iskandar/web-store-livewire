@props([
    'action' => true,
])

<thead class="text-xs text-gray-700 uppercase bg-gray-100">
    <tr>
        {{ $slot }}
        @if ($action)
            <th scope="col" class="px-6 py-3 w-16 text-center">aksi</th>
        @endif
    </tr>
</thead>
