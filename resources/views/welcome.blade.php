<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TONY ON THE TRACK</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <body>
         <div id="app">
             <entry></entry>
         </div>

         <script src="{{ asset('js/app.js')}}"></script>
    </body>
</html>
