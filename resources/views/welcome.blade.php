<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title >Welcome to TechKicks Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .animate-typing {
            animation: typing 3s steps(40, end), blink .75s step-end infinite;
            white-space: nowrap;
            overflow: hidden;
            border-right: 4px solid;
            width: 100%;
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        @keyframes blink {
            50% { border-color: transparent }
        }

        .card-link {
            animation: fadeInUp 0.8s ease-in-out both;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-green-100 to-yellow-100 min-h-screen flex flex-col items-center justify-center px-6 py-10">

    <!-- 🔠 Header -->
    <div class="text-center">
        <h1 class="text-4xl sm:text-5xl font-sans text-indigo-800 mb-4 animate-typing">
            🎓 Welkom op het TechKicks-platform!
        </h1>
        <p class="text-gray-700 font-sans max-w-2xl mx-auto mb-12">
        Ontdek, lees en groei! Een levendige digitale bibliotheek waar studenten en docenten samen kennis en verhalen delen.
        </p>
    </div>

    @php
        $cards = [
            [
                'image' => asset('images/library.png'),
                'title' => '📚 Verken de bibliotheek',
                'desc' => 'Ontdek een boeiende collectie kleurrijke en leerzame boeken, speciaal voor jou geselecteerd.',
                'link' => route('info.page'),
            ],
            [
                'image' => asset('images/interactive.png'),
                'title' => '🏆 Speciale boeken & Badges',
                'desc' => 'Verdien badges terwijl je leest en nieuwe, zorgvuldig gekozen titels verkent.',
                'link' => route('library.special'),
            ],
            [
                'image' => asset('images/projects.png'),
                'title' => '🎮 Leer & Speel!',
                'desc' => 'Daag jezelf uit en verbeter je leesvaardigheid met leuke en interactieve spellen!',
                'link' => route('library.games'),  // This is the game menu

            ]


        ];
    @endphp

    <!-- 🖼️ Cards Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 w-full max-w-6xl px-4 mt-6">
    @foreach($cards as $card)
    <a href="{{ $card['link'] }}"
       class="card-link bg-white rounded-3xl shadow-xl p-8 text-center hover:scale-105 transition-transform duration-500 w-full flex flex-col justify-start items-center hover:ring-4 ring-indigo-300">

        <img src="{{ $card['image'] }}" alt="Card image"php
             class="w-35 h-35 sm:w-36 sm:h-36 object-cover rounded-full border-4 border-indigo-300 shadow-lg transition-transform duration-500 hover:scale-110">

        <h3 class="text-xl sm:text-2xl font-sans text-indigo-700 mt-4">{{ $card['title'] }}</h3>
        <p class="text-gray-600 font-sans text-base mt-2">{{ $card['desc'] }}</p>
    </a>
@endforeach

    </div>

    <!-- 🚀 Buttons -->
    <div class="flex gap-6 font-sans mt-12">
        @foreach([
            ['text' => 'inloggen', 'route' => 'login', 'color' => 'bg-indigo-500 hover:bg-indigo-600'],
            ['text' => 'registreren', 'route' => 'register', 'color' => 'bg-green-500 hover:bg-green-600'],
        ] as $btn)
            <a href="{{ route($btn['route']) }}"
               class="{{ $btn['color'] }} text-white px-8 py-3 rounded-full font-sans text-lg shadow-lg transition-all transform hover:scale-110 animate-bounce hover:animate-none">
               {{ $btn['text'] }}
            </a>
        @endforeach
    </div>

        <!-- 🔚 Footer -->
        <footer class= "text-center mt-5">
                <h4 class="text-xl font-sans text-indigo-600">❓ Hulp Nodig?</h4>
                <p class="text-gray-700 font-sans">
                    Neem contact op met je docent of stuur ons een e-mail op <a href="mailto:support@techkicks.nl" class="text-indigo-600 underline">Rian@techkicks.nl</a>
                </p>
    </footer>


    </body>
</html>
