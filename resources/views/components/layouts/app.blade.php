<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
    <title>{{ $title ?? 'Page Title' }}</title>

    @livewireStyles
</head>

<body>

    @include('partials.navbar')

    {{ $slot }}

    @livewireScripts
</body>

</html>
