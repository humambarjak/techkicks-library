<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-center text-indigo-700 mt-4 drop-shadow animate-fade-in-top">
            🛠️ Boek bewerken
        </h2>
    </x-slot>

    @push('styles')
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out both;
        }
    </style>
    @endpush

    <br>
        <div class="max-w-2xl mx-auto bg-white/80 backdrop-blur-md border border-indigo-200 rounded-3xl shadow-2xl p-8">

            <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-1">📖 Titel</label>
                    <input type="text" name="title" value="{{ $book->title }}"
                        class="w-full p-3 border border-indigo-300 rounded-xl focus:ring-2 focus:ring-indigo-400 shadow-sm" required>
                </div>

                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-1">📝 Beschrijving</label>
                    <textarea name="description" rows="4"
                        class="w-full p-3 border border-indigo-300 rounded-xl focus:ring-2 focus:ring-indigo-400 shadow-sm">{{ $book->description }}</textarea>
                </div>

                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-1">📚 Categorie</label>
                    <select name="category"
                        class="w-full p-3 border border-indigo-300 rounded-xl focus:ring-2 focus:ring-indigo-400 shadow-sm" required>
                        <option value="">-- Kies een categorie --</option>
                        <option value="Stories" {{ $book->category == 'Stories' ? 'selected' : '' }}>📖 Verhalen</option>
                        <option value="Science" {{ $book->category == 'Science' ? 'selected' : '' }}>🔬 Wetenschap</option>
                        <option value="Comics" {{ $book->category == 'Comics' ? 'selected' : '' }}>🎨 Strips</option>
                        <option value="Adventure" {{ $book->category == 'Adventure' ? 'selected' : '' }}>🧭 Avontuur</option>
                        <option value="History" {{ $book->category == 'History' ? 'selected' : '' }}>🏛️ Geschiedenis</option>
                    </select>
                </div>

                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-1">🎯 AVI Niveau</label>
                    <select name="level" class="w-full p-3 border border-indigo-300 rounded-xl focus:ring-2 focus:ring-indigo-400 shadow-sm">
                        <option value="">-- Kies een AVI-niveau --</option>
                        <option value="AVI1" {{ $book->level == 'AVI1' ? 'selected' : '' }}>AVI 1</option>
                        <option value="AVI2" {{ $book->level == 'AVI2' ? 'selected' : '' }}>AVI 2</option>
                        <option value="AVI3" {{ $book->level == 'AVI3' ? 'selected' : '' }}>AVI 3</option>
                        <option value="AVI4" {{ $book->level == 'AVI4' ? 'selected' : '' }}>AVI 4</option>
                        <option value="AVI5" {{ $book->level == 'AVI5' ? 'selected' : '' }}>AVI 5</option>
                        <option value="AVI6" {{ $book->level == 'AVI6' ? 'selected' : '' }}>AVI 6</option>
                    </select>
                </div>


                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-2">🖼️ Huidige omslag</label>
                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="h-32 rounded-lg shadow mb-2 border border-indigo-200">
                    <input type="file" name="cover_image" class="text-sm text-gray-600">
                </div>

                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-2">📄 Huidige PDF</label>
                    <a href="{{ asset('storage/' . $book->pdf_file) }}" target="_blank" class="text-indigo-600 underline text-sm">📂 Bekijk PDF</a><br>
                    <input type="file" name="pdf_file" class="mt-2 text-sm text-gray-600">
                </div>

                <div>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_special" value="1"
                            class="rounded text-indigo-600 transition" {{ $book->is_special ? 'checked' : '' }}>
                        <span class="text-sm text-gray-700">✨ Markeer als speciaal boek</span>
                    </label>
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-3 rounded-full shadow-md transition transform hover:scale-105 animate-bounce">
                        💾 Boek bijwerken
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
