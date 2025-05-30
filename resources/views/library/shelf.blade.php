<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">❤️ Mijn Shelf</h2>
    </x-slot>
        <h1 class="text-4xl font-extrabold text-center text-indigo-700 mb-8 tracking-wide animate-dance glow-text">
             Jouw favoriete boeken
        </h1>

        @if ($earnedBadge)
            <div class="text-center mb-6">
                <span class="inline-block bg-green-500 text-white px-4 py-1 rounded-full shadow-md">
                    🏅 Super Reader (5+ boeken gelezen!)
                </span>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($books as $book)
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1 overflow-hidden border-4 border-pink-300 hover:border-indigo-400 book-card hover:animate-wiggle duration-300">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-52 object-cover" alt="Book Cover">
                    <div class="p-4">
                        <h3 class="text-xl font-bold text-indigo-700">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-600">{{ Str::limit($book->description, 60) }}</p>

                        <a href="{{ route('library.read', $book) }}"
                           onclick="handleBookChoice(event, this)"
                           class="inline-block mt-3 bg-indigo-500 text-white px-4 py-2 rounded-full hover:bg-indigo-600 transition duration-300">
                            👓 Lezen
                        </a>

                        <form method="POST" action="{{ route('books.favorite', $book) }}">
                            @csrf
                            <button type="submit" class="favorite-button mt-3">
                                <span>Niet meer favoriet</span>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-600 col-span-full text-lg">😢 Je hebt nog geen boeken als favoriet gemarkeerd.</p>
            @endforelse
        </div>

        <!-- 🎉 Toast message -->
        <div id="toast" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white text-indigo-700 border-4 border-yellow-400 px-8 py-5 rounded-2xl shadow-xl font-sans text-lg hidden z-50 text-center animate-bounce-in">
            🎉 Goede keuze! Veel leesplezier!
        </div>

    </div>

    <!-- JS for Flip + Toast (same as index page) -->
    <script>
        function handleBookChoice(event, button) {
            event.preventDefault();

            const card = button.closest('.book-card');
            const toast = document.getElementById('toast');

            const messages = [
                "🎉 Goede keuze! Veel leesplezier!",
                "📘 Dit boek wordt spannend!",
                "🥳 Veel leesplezier!",
                "✨ Je leestalent groeit!",
                "📚 Tijd voor avontuur!",
                "🚀 Klaar voor een nieuw verhaal?"
            ];
            const randomMessage = messages[Math.floor(Math.random() * messages.length)];
            toast.textContent = randomMessage;

            card.classList.add('animate-spin-book');
            toast.classList.remove('hidden');
            toast.classList.add('animate-bounce-in');

            setTimeout(() => {
                toast.classList.add('hidden');
            }, 2000);

            setTimeout(() => {
                window.location.href = button.href;
            }, 1200);
        }
    </script>

    <!-- CSS Animation (same as index) -->
    <style>
        @keyframes bounce-in {
            0% { opacity: 0; transform: translate(-50%, -50%) scale(0.8); }
            50% { opacity: 1; transform: translate(-50%, -50%) scale(1.05); }
            100% { transform: translate(-50%, -50%) scale(1); }
        }
        .animate-bounce-in {
            animation: bounce-in 0.6s ease-out;
        }

        @keyframes spin-book {
            0% { transform: rotateY(0); }
            50% { transform: rotateY(180deg); }
            100% { transform: rotateY(0); }
        }
        .animate-spin-book {
            animation: spin-book 0.8s ease-in-out;
        }

        @keyframes wiggle {
            0%, 100% { transform: rotate(0); }
            50% { transform: rotate(2deg); }
        }
        .animate-wiggle {
            animation: wiggle 0.6s ease-in-out infinite;
        }

        @keyframes dance {
            0%, 100% { transform: scale(1) rotate(0); }
            25% { transform: scale(1.05) rotate(-2deg); }
            50% { transform: scale(1.1) rotate(2deg); }
            75% { transform: scale(1.05) rotate(-1deg); }
        }
        .animate-dance {
            animation: dance 2.5s ease-in-out infinite;
        }

        @keyframes glow {
            0%, 100% { text-shadow: 0 0 8px #c4b5fd; }
            50% { text-shadow: 0 0 20px #8b5cf6; }
        }
        .glow-text {
            animation: glow 2s ease-in-out infinite;
        }

        .book-card {
            position: relative;
            overflow: hidden;
        }

        .book-card::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(135deg, rgba(255,255,255,0.05), transparent);
            animation: shimmer-bg 8s linear infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes shimmer-bg {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .favorite-button {
            padding: 5px 15px 5px 10px;
            border-radius: 10px;
            box-shadow: 0px 0px 5px 5px #e7413373;
            background-color: #e74133;
            color: white;
            font-size: 14px;
            border: none;
            display: inline-flex;
            align-items: center;
            transition: all .5s ease-in-out;
            letter-spacing: 1px;
        }

        .favorite-button:hover {
            background-color: #f54d3e;
            transition: all .5s ease-in-out;
            box-shadow: 0px 0px 5px 3px #e7413373;
        }

        .favorite-button::before {
            content: "";
            background-image: url("data:image/svg+xml;base64,...");
            background-size: 18px 18px;
            background-repeat: no-repeat;
            color: transparent;
            position: relative;
            width: 20px;
            height: 20px;
            display: block;
            margin-right: 5px;
            transition: all .5s ease-in-out;
        }

        .favorite-button:hover::before {
            transform: rotate(-1turn);
        }
    </style>
</x-app-layout>
