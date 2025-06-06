<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="website icon" href="{{asset("img/logo.png")}}">

        <title>{{ 'Busify' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-black antialiased">
        <div class="w-full h-auto flex flex-col md:flex-row overflow-y-auto">
            <div class="min-h-screen flex flex-col sm:justify-center items-center sm:pt-0 bg-gray-100 md:w-1/2 w-full p-10">
                <img src="{{asset("login.svg")}}" alt="Imagen Login">
            </div>
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 md:w-1/2 w-full">
                <div>
                    <a href="/">
                        <x-application-logo class="h-20 fill-current text-blue-500 text-7xl" />
                    </a>
                </div>
    
                <div class="w-full sm:max-w-md mt-3 px-6 py-4 bg-white shadow-md m-0 sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @include("components.loader")
    </body>
</html>
