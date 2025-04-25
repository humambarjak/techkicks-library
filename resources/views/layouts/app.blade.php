<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body {
            font-family: 'Comic Neue', cursive;
        }

        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out forwards;
        }

        @keyframes glow {
            0% { text-shadow: 0 0 5px #a5b4fc; }
            50% { text-shadow: 0 0 15px #6366f1; }
            100% { text-shadow: 0 0 5px #a5b4fc; }
        }

        .glow-text {
            animation: glow 2.5s ease-in-out infinite;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js?v=' . time()])
    @stack('styles')
    @stack('scripts')
</head>

<body class="font-sans antialiased">
<div class="min-h-screen @yield('page-background', 'bg-gradient-to-br from-blue-100 via-green-100 to-yellow-100')">

        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <div class="text-center mt-6 sm:mt-10 animate-fade-in">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-indigo-700 drop-shadow tracking-wide font-[Comic Neue] glow-text">
                    {{ $header }}
                </h1>
            </div>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
