<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-indigo-800 text-center mt-4 animate-bounce-in glow-text">
            📘 Mijn geüploade boeken
        </h2>
    </x-slot>

    <div class="min-h-screen from-blue-50 via-purple-50 to-pink-50 py-10 px-6">
        <div class="max-w-6xl mx-auto bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-bold text-indigo-700 animate-fade-in">
                    📚 Boekenlijst
                </h3>
                <a href="{{ route('books.create') }}"
                   class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold py-2 px-5 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition">
                    + Nieuw boek uploaden
                </a>
            </div>

            @if($books->count())
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 animate-fade-in-slow">
                    @foreach($books as $book)
                        <div class="relative bg-white border border-indigo-100 rounded-2xl p-4 shadow-xl hover:shadow-2xl transition-transform transform hover:-translate-y-1 duration-300 book-card">
                            @if($book->is_special)
                                <span class="absolute top-2 left-2 bg-purple-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow animate-pulse">
                                    ✨ Speciaal
                                </span>
                            @endif

                            @if($book->created_at->gt(now()->subDays(2)))
                                <span class="absolute top-2 right-2 bg-yellow-400 text-white text-xs font-bold px-2 py-1 rounded-full animate-bounce">
                                    🆕 Nieuw
                                </span>
                            @endif

                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover"
                                 class="w-full h-44 object-cover rounded-xl shadow-sm mb-3 transition-transform duration-300 hover:scale-105">

                                 <h4 class="text-lg font-bold text-indigo-800">
                            {{ $book->title }}
                            @if($book->is_special)
                                <span class="text-yellow-500 ml-1">⭐</span>
                            @endif
                        </h4>
                        @if($book->level)
                        <p class="text-sm text-indigo-600 font-semibold mt-1">
                            🎯 Niveau: {{ $book->level }}
                        </p>
                          @endif

                        @if($book->averageRating())
                            <p class="text-sm text-yellow-600 mt-1">
                                ⭐ {{ $book->averageRating() }} / 5
                            </p>
                        @endif

                        <div class="flex justify-between items-center mt-4">
                            <a href="{{ route('books.edit', $book) }}" class="text-xs font-semibold text-blue-600 hover:underline hover:scale-105 transition">
                                ✏️ Bewerking
                            </a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST"
                                onsubmit="return confirm('Weet je zeker dat je dit boek wilt verwijderen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-xs font-semibold text-red-500 hover:underline hover:scale-105 transition">
                                    🗑️ Verwijderen
                                </button>
                            </form>
                        </div>

                        <div class="flex justify-center mt-4">
                            <a href="{{ route('books.view', $book->id) }}"
                            class="bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-semibold px-4 py-2 rounded-full shadow-md transition-all duration-300 transform hover:-translate-y-1">
                                📖 Boek Bekijken
                            </a>
                        </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600 mt-10 text-lg animate-fade-in">📭 Je hebt nog geen boeken geüpload.</p>
            @endif
        </div>
    </div>

    <!-- Animations -->
    <style>
        @keyframes bounce-in {
            0% { opacity: 0; transform: scale(0.9) translateY(-10px); }
            50% { opacity: 1; transform: scale(1.05) translateY(4px); }
            100% { transform: scale(1) translateY(0); }
        }

        @keyframes fade-in {
            0% { opacity: 0; transform: translateY(10px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .animate-bounce-in {
            animation: bounce-in 0.8s ease-out;
        }

        .animate-fade-in {
            animation: fade-in 1s ease forwards;
        }

        .animate-fade-in-slow {
            animation: fade-in 1.8s ease forwards;
        }

        @keyframes glow {
            0%, 100% { text-shadow: 0 0 8px #c4b5fd; }
            50% { text-shadow: 0 0 20px #8b5cf6; }
        }

        .glow-text {
            animation: glow 2.5s ease-in-out infinite;
        }
    </style>
</x-app-layout>
