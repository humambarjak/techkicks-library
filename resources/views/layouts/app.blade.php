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
            font-family: 'script', sans-serif;
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
        #falling-stars {
    pointer-events: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 0;
    overflow: hidden;
}

#falling-stars .star, #falling-stars .bubble {
    position: absolute;
    top: -50px;
    font-size: 12px;
    opacity: 0.15;
    animation: fall linear infinite;
}

#falling-stars .star {
    color: rgba(255, 223, 88, 0.6);
}

#falling-stars .bubble {
    color: rgba(147, 197, 253, 0.4);
}

@keyframes fall {
    0% { transform: translateY(0) translateX(0) rotate(0deg); opacity: 0.3; }
    50% { transform: translateY(50vh) translateX(10px) rotate(180deg); opacity: 0.2; }
    100% { transform: translateY(100vh) translateX(-10px) rotate(360deg); opacity: 0; }
}

    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js?v=' . time()])
    @stack('styles')
    @stack('scripts')
</head>

<body class="@yield('page-background', 'bg-animated-pattern')" >
@if(Auth::check() && Auth::user()->role === 'student')
<div id="falling-stars"></div>
@endif


    <div class="min-h-screen @yield('page-background', 'bg-gradient-to-br from-blue-100 via-green-100 to-yellow-100')">

        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <div class="text-center mt-6 sm:mt-10 animate-fade-in">
                <h1 class="text-3xl sm:text-4xl sans-serif text-indigo-700 drop-shadow tracking-wide sans-serif glow-text">
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
    <script>
document.addEventListener("DOMContentLoaded", () => {
    const starsContainer = document.getElementById("falling-stars");
    if (!starsContainer) return;

    function createStarOrBubble() {
        const el = document.createElement("div");
        el.classList.add(Math.random() > 0.5 ? 'star' : 'bubble');
        el.style.left = Math.random() * 100 + "vw";
        el.style.animationDuration = (Math.random() * 7 + 8) + "s";
        el.innerHTML = Math.random() > 0.5 ? "⭐" : "🔵";
        starsContainer.appendChild(el);

        setTimeout(() => el.remove(), 12000);
    }

    setInterval(createStarOrBubble, 500);
});
</script>

</body>
</html>
