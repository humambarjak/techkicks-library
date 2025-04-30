@if (request()->is('library'))
    <!-- 📚 Floating Emoji Background (Only for Library page) -->
    <div class="floating-books-bg">
        @for ($i = 0; $i < 30; $i++)
            <span style="left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 10) }}s;">
                📚
            </span>
        @endfor
    </div>
@endif

<x-app-layout>
    <div class="min-h-screen bg-gradient-to-r from-blue-100 via-green-100 to-yellow-100">
    <h1 class="mt-10 text-3xl font-bold mb-6 text-center text-indigo-700 animate-dance glow-text inline-block w-full">
    📖 Welkom, {{ Auth::user()->name }}. Tijd om te lezen 
    </h1>
    @section('styles')
        <style>
            header.bg-white {
                background-color: transparent !important;
                box-shadow: none !important;
            }
        </style>
    @endsection
    \
        <!-- 🔍 Category Filter -->
        <form method="GET" action="{{ route('library.index') }}" class="mb-6 max-w-sm mx-auto">
            <label for="category" class="block text-lg mb-2 text-gray-800">Filter op categorie:</label>
            <select name="category" onchange="this.form.submit()" class="w-full border-2 border-indigo-400 rounded-lg p-2">
                <option value=""> Alle niveaus</option>
                <option value="Stories" {{ $selectedCategory == 'Stories' ? 'selected' : '' }}>🐣 AVI 1</option>
                <option value="Science" {{ $selectedCategory == 'Science' ? 'selected' : '' }}>🐥 AVI 2</option>
                <option value="Comics" {{ $selectedCategory == 'Comics' ? 'selected' : '' }}>📗 AVI 3</option>
                <option value="Adventure" {{ $selectedCategory == 'Adventure' ? 'selected' : '' }}>📘 AVI 4</option>
                <option value="History" {{ $selectedCategory == 'History' ? 'selected' : '' }}>🦉 AVI 5</option>
            </select>
        </form>
        

        <!-- 📚 Book Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($books as $book)
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl transition transform hover:-translate-y-1 overflow-hidden book-card hover:animate-wiggle duration-300 border-4 border-pink-300 hover:border-indigo-400">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-52 object-cover" alt="Book Cover">
                    <div class="p-4">
                        @if (isset($bookOfTheDay) && $book->id === $bookOfTheDay->id)
                            <span class="inline-block bg-yellow-400 text-black px-2 py-1 text-xs rounded-full mb-2">
                                🌟 Boek van de dag
                            </span>
                        @endif

                        <h3 class="text-xl font-semibold text-indigo-700">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $book->description }}</p>
                        @if($book->level)
                            <p class="text-sm text-indigo-600 font-semibold mt-1">
                                🎯 Niveau: {{ $book->level }}
                            </p>
                        @endif


                        <a href="{{ route('library.read', $book) }}"
                           onclick="handleBookChoice(event, this)"
                           class="inline-block mt-3 bg-indigo-500 text-white px-4 py-2 rounded-full hover:bg-indigo-600 transition duration-300">
                            👓 Lezen
                        </a>

                        @if($book->averageRating())
                            <p class="text-sm text-yellow-600 mt-2">
                                Gemiddelde beoordeling:
                                {{ str_repeat('⭐', floor($book->averageRating())) }}
                                <span class="text-xs text-gray-500">({{ $book->averageRating() }}/5)</span>
                            </p>
                        @endif

                        <form method="POST" action="{{ route('books.favorite', $book) }}">
    @csrf
    <button type="submit" class="favorite-button">
        <span>
            {{ auth()->user()->favoriteBooks->contains($book) ? 'Niet meer favoriet' : 'Favoriet' }}
        </span>
    </button>
</form>
                    </div>
                </div>
            @endforeach
        </div>

        @if($books->isEmpty())
            <p class="text-center text-gray-600 mt-10 text-lg">😕 Geen boeken gevonden in deze categorie.</p>
        @endif

        <!-- 🎉 Centered Toast -->
        <div id="toast"
             class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
                    bg-white text-indigo-700 border-4 border-yellow-400 px-8 py-5 
                    rounded-2xl shadow-xl font-bold text-lg hidden z-50 text-center animate-bounce-in">
            🎉 Goede keuze! Veel leesplezier!
        </div>

        <!-- JavaScript for Toast & Animation -->
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

        <!-- 🖌️ All Styling -->
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

            .floating-books-bg {
                position: fixed;
                bottom: -2rem;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
                overflow: hidden;
                z-index: 0;
            }

            .floating-books-bg span {
                position: absolute;
                font-size: 1.5rem;
                animation: float-up 10s linear infinite;
                opacity: 0.3;
            }

            @keyframes float-up {
                0% { transform: translateY(100vh) rotate(0deg); }
                100% { transform: translateY(-10vh) rotate(360deg); }
            }
            .favorite-button {
  padding: 5px 15px 5px 10px; /* smaller and tighter */
  border-radius: 10px;
  box-shadow: 0px 0px 5px 5px #e7413373;
  background-color: #e74133;
  color: white;
  font-size: 14px; /* smaller text */
  border: none;
  display: inline-flex; /* ✅ fix inline with text */
  align-items: center;
  transition: all .5s ease-in-out;
  letter-spacing: 1px;
  margin-top: 8px;
}

.favorite-button:hover {
  background-color: #f54d3e;
  transition: all .5s ease-in-out;
  box-shadow: 0px 0px 5px 3px #e7413373;
}

.favorite-button::before {
  content: "";
  background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNzUycHQiIGhlaWdodD0iNzUycHQiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDc1MiA3NTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiA8cGF0aCBkPSJtMzc2LjMyIDU1Mi4zYy0wLjM4NjcyIDAtMC43ODEyNS0wLjAxNTYyNS0xLjE3MTktMC4wNTA3ODEtMS4wNzgxLTAuMDc0MjE5LTIuMTM2Ny0wLjI2NTYyLTMuMTU2Mi0wLjU0Njg4LTIuNzMwNS0wLjU5Mzc1LTUuMjkzLTEuODUxNi03LjM0MzgtMy43ODEybC0xMzcuNTQtMTI5LjY2Yy00NC40NTMtNDEuOTAyLTQ5LjQ4LTExNS40Ni0xMS4yMTUtMTYzLjk3IDE5LjA4Mi0yNC4xODQgNDUuNzctMzguNjk1IDc1LjE1Mi00MC44NTUgMjguOTMtMi4xMTcyIDU2Ljg2MyA4LjAzMTIgNzguNjggMjguNTk4bDYuMjY1NiA1LjkwMjMgNi4yNjU2LTUuOTAyM2MyMS44MzItMjAuNTcgNDkuODA1LTMwLjY5MSA3OC42OTEtMjguNTk4IDI5LjM4MyAyLjE2NDEgNTYuMDY2IDE2LjY3NiA3NS4xNDUgNDAuODU1IDM4LjI2MiA0OC41MTIgMzMuMjM0IDEyMi4wNy0xMS4yMTUgMTYzLjk3bC0xMzcuNTQgMTI5LjY3Yy0yLjk5MjIgMi44MTY0LTYuOTM3NSA0LjM3NS0xMS4wMjMgNC4zNzV6IiBmaWxsPSIjZmZmIi8+Cjwvc3ZnPgo=");
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
  background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNzUycHQiIGhlaWdodD0iNzUycHQiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDc1MiA3NTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiA8cGF0aCBkPSJtMzY5Ljg0IDU1MC4yOGMwLjQ3MjY2IDAuNDcyNjYgMC45NDUzMSAwLjQ3MjY2IDAuOTQ1MzEgMC45NDUzMSA2NS4zNTUtNTEuNjIxIDE5My43LTE0OC4yMyAxOTMuNy0yNDkuMTEgMC01NS44ODMtNDUuNDY1LTEwMS4zNS0xMDEuMzUtMTAxLjM1LTM5Ljc4MSAwLTc0LjM1MiAyMy4yMDctOTAuOTI2IDU2LjgyOC0wLjQ3MjY2IDAuOTQ1MzEtMS40MjE5IDMuMzE2NC0xLjQyMTkgMy4zMTY0cy0wLjk0NTMxLTEuODk0NS0wLjk0NTMxLTIuMzY3MmMtMTYuMTAyLTM0LjA5LTUwLjY3Mi01Ny43Ny05MC45MjYtNTcuNzctNTUuODgzIDAtMTAxLjM1IDQ1LjQ2MS0xMDEuMzUgMTAxLjM0IDAgMTAxLjgyIDEyNy44NyAxOTcuMDEgMTkyLjI3IDI0OC4xNnoiIGZpbGw9IiNmZmYiLz4KPC9zdmc+Cg==");
  transition: all .5s ease-in-out;
  transform: rotate(-1turn);
}
        </style>
    </div>
</x-app-layout>
