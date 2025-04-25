<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-extrabold text-center text-indigo-700 mt-4 drop-shadow animate-fade-in-top">
             Nieuw boek uploaden
        </h2>
    </x-slot>

    @push('styles')
    <style>
        header.bg-white {
            background-color: transparent !important;
            box-shadow: none !important;
        }

        /* ✨ Smooth fade-in animation */
        @keyframes fadeInTop {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-top {
            animation: fadeInTop 0.8s ease-out both;
        }

        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out both;
        }
    </style>
    @endpush

        <br>
        <div class="max-w-xl mx-auto bg-white/80 backdrop-blur-lg border border-indigo-100 rounded-3xl shadow-2xl p-8 animate-fade-in-up">
            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-4 text-sm text-red-600 shadow">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-1">📖 Boektitel</label>
                    <input type="text" name="title" class="w-full p-3 border border-indigo-300 rounded-xl focus:ring-2 focus:ring-indigo-400 shadow-sm" required>
                </div>

                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-1">📝 Beschrijving</label>
                    <textarea name="description" rows="4" class="w-full p-3 border border-indigo-300 rounded-xl focus:ring-2 focus:ring-indigo-400 shadow-sm"></textarea>
                </div>

                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-1">📚 Categorie</label>
                    <select name="category" class="w-full p-3 border border-indigo-300 rounded-xl focus:ring-2 focus:ring-indigo-400 shadow-sm" required>
                        <option value="">-- Kies een categorie --</option>
                        <option value="Stories">📖 Verhalen</option>
                        <option value="Science">🔬 Wetenschap</option>
                        <option value="Comics">🎨 Strips</option>
                        <option value="Adventure">🧭 Avontuur</option>
                        <option value="History">🏛️ Geschiedenis</option>
                    </select>
                </div>

                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-1">🖼️ Omslagafbeelding</label>
                    <input type="file" name="cover_image" class="w-full text-sm text-gray-600" required>
                </div>

                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-1">📄 PDF-bestand</label>
                    <input type="file" name="pdf_file" class="w-full text-sm text-gray-600" required>
                </div>

                <div>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_special" value="1" class="rounded text-indigo-600 transition">
                        <span class="text-sm text-gray-700">✨ Markeer als speciaal boek</span>
                    </label>
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-3 rounded-full shadow-md transition transform hover:scale-105">
                        🚀 Boek uploaden
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
