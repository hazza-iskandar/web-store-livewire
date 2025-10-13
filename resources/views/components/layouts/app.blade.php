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

    @include('partials.footer')
</body>

</html>
