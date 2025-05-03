<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-sans text-indigo-800 text-center mt-4 animate-bounce-in glow-text">
            📘 Mijn geüploade boeken
        </h2>
    </x-slot>

    <div class="min-h-screen from-blue-50 via-purple-50 to-pink-50 py-10 px-6">
        <div class="max-w-6xl mx-auto bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-sans text-indigo-700 animate-fade-in">
                    📚 Boekenlijst
                </h3>
                <a href="{{ route('books.create') }}"
                   class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-sans py-2 px-5 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition">
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

                                 <h4 class="text-lg font-sans text-indigo-800">
                            {{ $book->title }}
                            @if($book->is_special)
                                <span class="text-yellow-500 ml-1">⭐</span>
                            @endif
                        </h4>
                        @if($book->level)
                        <p class="text-sm text-indigo-600 font-sans mt-1">
                            🎯 Niveau: {{ $book->level }}
                        </p>
                          @endif

                        @if($book->averageRating())
                            <p class="text-sm text-yellow-600 mt-1">
                                ⭐ {{ $book->averageRating() }} / 5
                            </p>
                        @endif

                        <div class="flex justify-around items-center mt-4 space-x-2">
    <a href="{{ route('books.edit', $book) }}" class="edit-button" title="Bewerken">
        <svg class="edit-svgIcon" viewBox="0 0 512 512">
            <path fill="white" d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231z"></path>
        </svg>
    </a>

    <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit boek wilt verwijderen?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="delete-button" title="Verwijderen">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svgIcon">
  <path fill="white" d="M135.2 17.7C140.7 7.3 151.9 0 164 0H284c12.1 0 23.3 7.3 28.8 17.7L336 32H432c8.8 0 16 7.2 16 16s-7.2 16-16 16H416l-23 371c-1.4 23.1-20.5 41-43.6 41H98.6c-23.1 0-42.2-17.9-43.6-41L32 64H16C7.2 64 0 56.8 0 48S7.2 32 16 32H112l23.2-14.3zM128 128v288c0 8.8 7.2 16 16 16s16-7.2 16-16V128c0-8.8-7.2-16-16-16s-16 7.2-16 16zm96 0v288c0 8.8 7.2 16 16 16s16-7.2 16-16V128c0-8.8-7.2-16-16-16s-16 7.2-16 16zm96 0v288c0 8.8 7.2 16 16 16s16-7.2 16-16V128c0-8.8-7.2-16-16-16s-16 7.2-16 16z"/>
</svg>

    </button>
</form>

    <a href="{{ route('books.view', $book->id) }}" class="bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-sans px-4 py-2 rounded-full shadow-md transition-all duration-300 transform hover:-translate-y-1">
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
        .edit-button {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: rgb(99, 102, 241);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.2);
        transition: 0.3s;
        }

        .edit-button svg {
        width: 16px;
        transition: transform 0.3s ease;
        }

        .edit-button:hover {
        width: 100px;
        border-radius: 9999px;
        background-color:rgb(0, 158, 13);
        }

        .edit-button:hover svg {
        transform: rotate(360deg);
        }


        .delete-button {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: rgb(99, 102, 241);
        display: flex;
        justify-content: center;
        align-items: center;
        transition: 0.3s;
    }

    .delete-button:hover {
        background-color: rgb(255, 5, 5);
    }

    .delete-button .svgIcon {
        width: 24px;
        height: 24px;
        fill: white;
        display: block;
        object-fit: contain;
    }


    </style>
</x-app-layout>
