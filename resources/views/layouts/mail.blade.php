<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The Official website for Producer Tony Gregory aka TonyOnTheTrack! | Get Your Bangers Here! | Gengetone, Drill, Hip Hop, Afrobeats">
    <meta name="keywords" content="Producer, Beat Maker, Beats, TonyOnTheTrack,Tony Gregory,Gengetone, Drill, Hip Hop, Kenya Beats,Afrobeats,Music">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('mail-styles')
</head>
<body>
<div id="app">
    <main>
        @yield('mail-body')
    </main>
</div>
</body>
</html>
