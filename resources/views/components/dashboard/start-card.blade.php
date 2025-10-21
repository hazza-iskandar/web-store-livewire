@props([
    'title' => 'Total Barang',
    'value' => '0',
    'icon' => '',
    'color' => ''
])

<div class="bg-white shadow-sm rounded-lg p-5 flex items-center justify-between">
    <div>
        <h3 class="text-sm text-gray-500 font-medium">{{ $title }}</h3>
        <p class="text-2xl font-semibold text-gray-800 mt-1">{{ $value }}</p>
    </div>
    <span class="{{ $color }} text-3xl">
        <i class="{{ $icon }}"></i>
    </span>
</div>
