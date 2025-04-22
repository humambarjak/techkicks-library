<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight"></h2>
    </x-slot>

    @section('styles')
        <style>
            header.bg-white {
                background-color: transparent !important;
                box-shadow: none !important;
            }
        </style>
    @endsection

    <div class="min-h-screen {{ request()->is('library') ? '' : 'bg-gradient-to-r from-blue-100 via-green-100 to-yellow-100' }}">
        <h1 class="text-3xl font-bold mb-6 text-center text-indigo-700">
            📖 Welkom, {{ Auth::user()->name }}! Laten we lezen!
        </h1>

        {{-- 🔍 Category Filter --}}
        <form method="GET" action="{{ route('library.index') }}" class="mb-6 max-w-sm mx-auto">
            <label for="category" class="block text-lg mb-2 text-gray-800">Filter op categorie:</label>
            <select name="category" onchange="this.form.submit()" class="w-full border-2 border-indigo-400 rounded-lg p-2">
                <option value="">📚 Alle categorieën</option>
                <option value="Stories" {{ $selectedCategory == 'Stories' ? 'selected' : '' }}>🐣 AVI 1</option>
                <option value="Science" {{ $selectedCategory == 'Science' ? 'selected' : '' }}>🐥 AVI 2</option>
                <option value="Comics" {{ $selectedCategory == 'Comics' ? 'selected' : '' }}>📗 AVI 3</option>
                <option value="Adventure" {{ $selectedCategory == 'Adventure' ? 'selected' : '' }}>📘 AVI 4</option>
                <option value="History" {{ $selectedCategory == 'History' ? 'selected' : '' }}>🦉 AVI 5</option>
            </select>
        </form>

        {{-- 📚 Book Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($books as $book)
                <div class="bg-white rounded-2xl shadow-lg transform hover:-translate-y-2 hover:scale-105 transition-all duration-300 overflow-hidden border-4 border-pink-300">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-52 object-cover" alt="Book Cover">
                    <div class="p-4">
                        <!-- 🌟 Book of the Day Badge -->
                        @if (isset($bookOfTheDay) && $book->id === $bookOfTheDay->id)
                            <span class="inline-block bg-yellow-400 text-black px-2 py-1 text-xs rounded-full mb-2">
                                🌟 Boek van de dag
                            </span>
                        @endif

                        <h3 class="text-xl font-semibold text-indigo-700">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-600">{{ Str::limit($book->description, 60) }}</p>

                        <a href="{{ route('library.read', $book) }}" class="inline-block mt-3 bg-indigo-500 text-white px-4 py-2 rounded-full hover:bg-indigo-600">
                            👓 Lezen
                        </a>

                        <!-- ⭐ Average Rating (inside card only) -->
                        @if($book->averageRating())
                            <p class="text-sm text-yellow-600 mt-2">
                                Gemiddelde beoordeling:
                                {{ str_repeat('⭐', floor($book->averageRating())) }}
                                <span class="text-xs text-gray-500">({{ $book->averageRating() }}/5)</span>
                            </p>
                        @endif

                        <!-- ❤️ Favorite Button -->
                        <form method="POST" action="{{ route('books.favorite', $book) }}">
                            @csrf
                            <button type="submit" class="mt-2 text-red-500 hover:text-red-700">
                                ❤️ {{ auth()->user()->favoriteBooks->contains($book) ? 'Niet meer favoriet' : 'Favoriet' }}
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        @if($books->isEmpty())
            <p class="text-center text-gray-600 mt-10 text-lg">😕 Geen boeken gevonden in deze categorie.</p>
        @endif
    </div>
</x-app-layout>
