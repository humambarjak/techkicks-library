@section('page-background', 'bg-animated-pattern')

<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-extrabold text-indigo-700 font-[Comic Neue] drop-shadow-sm tracking-wide">
            {{ __('Dashboard') }}
        </h1>
    </x-slot>

    @if(Auth::user()->role === 'student')
        <audio id="welcomeSound" src="/sounds/welcome.mp3" preload="auto"></audio>
    @endif

    <div class="min-h-screen py-12 px-4">
        <div class="relative z-10 max-w-2xl mx-auto bg-white p-8 rounded-3xl shadow-2xl text-center border-2 border-indigo-200 animate-fade-in welcome-box overflow-hidden">

            @if(Auth::user()->role === 'student')
                <div class="absolute inset-0 pointer-events-none z-0">
                    <div class="floating-inside">📚</div>
                    <div class="floating-inside delay-1">📘</div>
                    <div class="floating-inside delay-2">📖</div>
                </div>
            @endif

            <div class="relative z-10">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-indigo-700 mb-2 {{ Auth::user()->role === 'student' ? 'typing' : 'glow-text' }}">
                    👋 Welkom terug, {{ Auth::user()->name }}
                </h1>
                <p class="text-lg text-gray-600 mb-6">
                    <span class="text-sm text-gray-400">({{ ucfirst(Auth::user()->role) }})</span>
                </p>

                @if(Auth::user()->role === 'student')
                    <p class="text-green-600 text-lg font-semibold mb-4">📚 Laten we op zoek gaan naar jouw volgende boek</p>
                    <a href="{{ route('library.index') }}" class="inline-block bg-yellow-300 hover:bg-yellow-400 text-indigo-900 font-bold px-6 py-2 rounded-full shadow-md transition">
                        Ga naar bibliotheek 📖
                    </a>
                @elseif(Auth::user()->role === 'teacher')
                    <p class="text-blue-600 text-lg font-semibold mb-4">🧑‍🏫 Tijd om kennis te delen</p>
                    <a href="{{ route('books.index') }}" class="inline-block bg-blue-200 hover:bg-blue-300 text-blue-800 font-bold px-6 py-2 rounded-full shadow-md transition">
                        Beheer mijn boeken 📘
                    </a>
                @endif

                <div class="mt-6 bg-indigo-100 text-indigo-800 rounded-xl py-4 px-6 shadow-inner animate-pulse-slow">
                    <p class="font-semibold">💡 Tip van de dag:</p>
                    <p id="dailyTip" class="mt-1 text-sm italic"></p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fade-in 0.8s ease-out forwards;
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        .typing {
            display: inline-block;
            overflow: hidden;
            border-right: .15em solid orange;
            white-space: nowrap;
            animation: typing 3s steps(40, end), blink-caret 0.75s step-end infinite;
        }

        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: orange; }
        }

        @keyframes pulse-slow {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.02); opacity: 0.9; }
        }

        .animate-pulse-slow {
            animation: pulse-slow 4s ease-in-out infinite;
        }

        .bg-animated-pattern {
            background: linear-gradient(270deg, #fdf6fd, #f0faff, #fdfde7, #e8fff0);
            background-size: 400% 400%;
            animation: bg-wave 20s ease infinite;
        }

        @keyframes bg-wave {
            0% { background-position: 0 0; }
            100% { background-position: 400% 0; }
        }

        .glow-text {
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from { text-shadow: 0 0 5px #9f7aea, 0 0 10px #9f7aea; }
            to { text-shadow: 0 0 10px #6b46c1, 0 0 20px #6b46c1; }
        }

        .floating-inside {
            position: absolute;
            font-size: 1.5rem;
            animation: float-inside 2s linear infinite;
            top: 100%;
            left: 10%;
            opacity: 0.7;
        }

        .floating-inside.delay-1 { left: 50%; animation-delay: 4s; }
        .floating-inside.delay-2 { left: 80%; animation-delay: 8s; }

        @keyframes float-inside {
            0% { transform: translateY(0); opacity: 0; }
            10% { opacity: 1; }
            100% { transform: translateY(-120%); opacity: 0; }
        }
    </style>

    <script>
        window.addEventListener('load', () => {
            @if(Auth::user()->role === 'student')
            const sound = document.getElementById('welcomeSound');
            if (sound) sound.play();
            @endif

            const tips = {
                student: [
                    "📚 Wist je dat je boeken als favoriet kunt markeren met ❤️?",
                    "💡 Probeer vandaag een nieuwe categorie te verkennen!",
                    "📝 Vergeet niet om notities te maken terwijl je leest!",
                    "🎯 Daag jezelf uit met de emoji quiz!",
                ],
                teacher: [
                    "📘 Voeg vandaag een nieuw boek toe voor je klas!",
                    "💡 Houd de voortgang van je studenten bij via het dashboard.",
                    "🛠️ Je kunt boeken snel bewerken of verwijderen in je overzicht.",
                    "✨ Vergeet niet: motivatie begint met inspiratie!",
                ]
            };

            const role = "{{ Auth::user()->role }}";
            const randomTip = tips[role][Math.floor(Math.random() * tips[role].length)];
            document.getElementById('dailyTip').textContent = randomTip;
        });
    </script>
</x-app-layout>
