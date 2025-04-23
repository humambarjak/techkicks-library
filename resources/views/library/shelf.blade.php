<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">❤️ Mijn Shelf</h2>
    </x-slot>

    <div class="min-h-screen {{ request()->is('library') || request()->is('library/shelf') ? '' : 'bg-gradient-to-r from-blue-100 via-green-100 to-yellow-100' }}">

        <h1 class="text-4xl font-extrabold text-center text-indigo-700 mb-8 tracking-wide">
             Jouw favoriete boeken
        </h1>

        @if ($earnedBadge)
            <div class="text-center mb-6">
                <span class="inline-block bg-green-500 text-white px-4 py-1 rounded-full shadow-md">
                    🏅 Super Reader (5+ books read!)
                </span>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($books as $book)
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1 overflow-hidden border border-red-300">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-52 object-cover" alt="Book Cover">
                    <div class="p-4">
                        <h3 class="text-xl font-bold text-indigo-700">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-600">{{ Str::limit($book->description, 60) }}</p>

                        <a href="{{ route('library.read', $book) }}"
                           class="inline-block mt-3 bg-indigo-500 text-white px-4 py-2 rounded-full hover:bg-indigo-600 transition-all duration-200">
                            👓 Lezen
                        </a>

                        <!-- ❤️ Unfavorite Button -->
                        <form method="POST" action="{{ route('books.favorite', $book) }}">
                            @csrf
                            <button type="submit"
                                    class="mt-2 text-red-500 hover:text-red-700 block transition-all">
                                ❌ Niet meer favoriet
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-600 col-span-full text-lg">😢 Je hebt nog geen boeken als favoriet gemarkeerd.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
