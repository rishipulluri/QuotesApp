<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <title> @yield('title') </title>
        <link rel="stylesheet" href="{{ URL::secure('css/main.css') }}" type="text/css" />
        <link rel="stylesheet" href="/public/main.css" type="text/css" />

        @yield('styles')
    </head>
    <body>
        @include('includes.header') 
        <div class = "main">
            @yield('content') 
            {{-- the yield basically specifies that any class that extends this one and has 
              -- the content identifier will be outputted 
              --}}
        </div>
    </body>
</html>