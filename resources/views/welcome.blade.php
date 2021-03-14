<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="The Official website for Producer Tony Gregory aka TonyOnTheTrack! | Get Your Bangers Here! | Gengetone, Drill, Hip Hop, Afrobeats">
        <meta name="keywords" content="Producer, Beat Maker, Beats, TonyOnTheTrack,Tony Gregory,Gengetone, Drill, Hip Hop, Kenya Beats,Afrobeats,Music">

        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
{{--        <script src="https//www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}"></script>--}}
    </head>
    <body>
         <div id="app">
             <entry></entry>
         </div>

         <script src="{{ asset('js/app.js')}}"></script>
    </body>
</html>
