<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
    <title>{{ $title ?? config('app.name') }}</title>

    @livewireStyles
</head>

<body>

    <x-navmenu />

    {{ $slot }}

    <x-footer />

    @livewireScripts

    {{-- ini untuk js flowbite --}}
    <script>
        document.addEventListener('livewire:navigated', () => {
            if (typeof initFlowbite === 'function') initFlowbite();
        });

    </script>


    <script src="{{ asset('assets/js/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper/custom-swiper.js') }}"></script>

</body>

</html>
