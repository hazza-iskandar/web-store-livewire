<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
    <title>{{ $title ?? config('app.name') }}</title>

    @livewireStyles
</head>

<body>

    <x-dashboard.navbar/>

    <x-dashboard.sidebar />

    {{ $slot }}

    @livewireScripts

    @include('partials.footer')
</body>

</html>
