<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Comic Neue', cursive;
            }
        </style>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js?v=' . time()])

        @stack('styles')
        @stack('scripts')


    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-blue-100 via-green-100 to-yellow-100">


    <div class="min-h-screen">


            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
            <header class="bg-transparent px-4 mt-6 sm:mt-10 animate-fade-in">
            <div class="text-center">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-indigo-700 drop-shadow tracking-wide font-[Comic Neue]">

                    {{ $header }}
                </h1>
            </div>
        </header>

        @endisset


            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
    @stack('scripts')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


</html>
