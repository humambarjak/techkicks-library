<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-100 via-green-100 to-yellow-100 py-16 px-6">
        <div class="max-w-6xl mx-auto">

            <!-- 🌟 Page Title -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-indigo-800 drop-shadow">📊 Leesvoortgang</h1>
                <p class="text-gray-700 text-lg mt-2">Bekijk welke boeken je studenten hebben gelezen</p>
            </div>

            <!-- 🔍 Filters -->
            <form method="GET" class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-8">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Zoek student..."
                    class="px-4 py-2 border rounded-lg shadow-sm w-64">

                <select name="sort" class="px-7 py-2 border rounded-lg shadow-sm">
                    <option value="">Sorteer op</option>
                    <option value="most" {{ request('sort') == 'most' ? 'selected' : '' }}>📈 Meeste boeken gelezen</option>
                    <option value="least" {{ request('sort') == 'least' ? 'selected' : '' }}>📉 Minste boeken gelezen</option>
                </select>

                <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg shadow hover:bg-indigo-700 transition">
                    Filteren
                </button>
            </form>

            <!-- 👥 Student Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($students as $student)
                    <div class="bg-white rounded-3xl shadow-xl p-6 hover:shadow-indigo-200 transition-all duration-300">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="https://api.dicebear.com/6.x/fun-emoji/svg?seed={{ $student->id }}"
                                 class="h-14 w-14 rounded-full border shadow" />
                            <div>
                                <h2 class="text-xl font-semibold text-indigo-700">{{ $student->name }}</h2>
                                <p class="text-sm text-gray-500">{{ $student->email }}</p>
                                <p class="text-sm text-gray-500 mt-1">📚 Boeken gelezen: {{ $student->books_read->count() }}</p>
                            </div>
                        </div>

                        @if($student->books_read->count())
                            <div>
                                <h3 class="text-sm font-semibold text-indigo-500 mb-2">📘 Gelezen boeken:</h3>
                                <ul class="space-y-2">
                                    @foreach($student->books_read as $book)
                                        <li class="flex justify-between text-sm text-gray-700 bg-gray-100 rounded-xl px-4 py-2">
                                            <div>
                                                <span>{{ $book->title }}</span>
                                                @if($book->pivot->last_page)
                                                    <span class="text-xs text-green-600 ml-2">
                                                        📖 Pagina: {{ $book->pivot->last_page }}
                                                    </span>
                                                @endif
                                            </div>
                                            <span class="text-gray-400 text-xs">
                                                {{ $book->pivot->created_at->diffForHumans() }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <p class="text-gray-500 italic">📭 Nog geen boeken gelezen</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
