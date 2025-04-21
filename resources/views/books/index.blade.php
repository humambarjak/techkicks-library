<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-indigo-800 leading-tight text-center">
            📘 Mijn geüploade boeken
        </h2>
    </x-slot>
    <br>
    <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-xl p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-semibold text-indigo-700">📚 Boekenlijst</h3>
            <a href="{{ route('books.create') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200 shadow-md">
                + Nieuw boek uploaden
            </a>
        </div>

    @if($books->count())
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($books as $book)
                        <div class="bg-white border border-indigo-100 rounded-2xl p-4 shadow-md hover:shadow-lg transition transform hover:-translate-y-1 relative">
                        @if($book->is_special)
                        <span class="absolute top-2 left-2 bg-purple-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow">
                            ✨ Speciaal
                        </span>
                    @endif

            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover"
                class="w-full h-40 object-cover rounded-lg mb-3">

                    <h4 class="text-lg font-bold text-indigo-800 mb-1">
                        {{ $book->title }}
                         @if($book->is_special)
                        <span class="text-yellow-500 ml-1">⭐</span>
                         @endif
                        </h4>
                        <!-- new -->
                        @if($book->averageRating())
    <p class="text-sm text-yellow-600 mt-1">
        ⭐ {{ $book->averageRating() }} / 5
    </p>
@endif

                            {{-- Badge for new books --}}
                            @if($book->created_at->gt(now()->subDays(2)))
                                <span class="absolute top-2 right-2 bg-yellow-400 text-xs font-bold text-white px-2 py-1 rounded-full animate-pulse">
                                    🆕 Nieuw
                                </span>
                            @endif

                            <div class="flex justify-between items-center mt-4">
                                <a href="{{ route('books.edit', $book) }}"
                                   class="text-sm font-semibold text-blue-600 hover:underline transition">
                                    ✏️ Bewerking
                                </a>

                                <form action="{{ route('books.destroy', $book) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this book?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-sm font-semibold text-red-500 hover:underline transition">
                                        🗑️ Verwijderen
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600 mt-8 text-lg">📭 You haven't uploaded any books yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>