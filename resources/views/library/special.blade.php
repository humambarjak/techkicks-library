<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-pink-100 via-yellow-100 to-green-100 py-12 px-6">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-indigo-700 mb-2 drop-shadow">🏅 Speciale Boeken & Badges</h1>
            <p class="text-gray-700 text-lg">Blader door exclusieve boeken & verdien badges als top-lezer! 📚</p>
        </div>

        <!-- 🔎 Filters -->
        <form method="GET" class="max-w-4xl mx-auto mb-10 flex flex-col sm:flex-row gap-4 justify-center items-center">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Zoek op titel..."
                class="w-full sm:w-1/3 px-4 py-2 border rounded-full shadow text-sm">

            <select name="category" class="px-7 py-2 rounded-full shadow text-sm border">
                <option value="">Alle categorieën</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>

            <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-8 py-2 rounded-full text-sm shadow">
                Filteren
            </button>
        </form>

        <!-- 📚 Book Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto mb-12">
            @forelse ($books as $book)
                <div class="bg-white rounded-3xl shadow-xl p-6 hover:scale-105 transition duration-300 text-left">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="h-40 w-full object-cover rounded-xl mb-4 shadow">
                    <h3 class="text-xl font-bold text-indigo-700">{{ $book->title }}</h3>
                    <p class="text-sm text-gray-500 mb-1">📂 Categorie: {{ $book->category }}</p>
                    <p class="text-sm text-gray-500 mb-1">📖 Pagina's: {{ $book->pages ?? 'nvt' }}</p>

                    <!-- ⭐ Star Rating -->
                    <div class="flex items-center gap-1 mb-2">
                        @php $rating = rand(3, 5); @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            @if($i <= $rating)
                                <span class="text-yellow-400">★</span>
                            @else
                                <span class="text-gray-300">☆</span>
                            @endif
                        @endfor
                        <span class="text-xs text-gray-500 ml-1">({{ rand(10, 100) }} reviews)</span>
                    </div>

                    <a href="{{ route('library.read', $book->id) }}"
                        class="mt-2 inline-block bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-full text-sm shadow">
                        📚 Lezen
                    </a>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">Geen boeken gevonden.</p>
            @endforelse
        </div>

        <!-- 📄 Pagination -->
        <div class="text-center">
            {{ $books->links() }}
        </div>
    </div>
</x-app-layout>
