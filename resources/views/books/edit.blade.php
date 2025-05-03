<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-sans text-center text-indigo-700 mt-4 drop-shadow animate-fade-in-top">
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
        .icon-btn {
  width: 50px;
  height: 50px;
  border: 1px solid #cdcdcd;
  background: white;
  border-radius: 25px;
  overflow: hidden;
  position: relative;
  transition: width 0.2s ease-in-out;
  font-weight: 500;
  font-family: sans;-serif;
  display: flex;
  align-items: center;
  justify-content: start;
  padding-left: 12px;
  gap: 10px;
}

.add-btn:hover {
  width: 140px;
}

.add-btn-blue::before,
.add-btn-blue::after {
  transition: width 0.2s ease-in-out, border-radius 0.2s ease-in-out;
  content: "";
  position: absolute;
  height: 4px;
  width: 10px;
  top: calc(50% - 2px);
  background: #3b82f6;
}

.add-btn-blue::after {
  right: 14px;
  border-top-right-radius: 2px;
  border-bottom-right-radius: 2px;
}

.add-btn-blue::before {
  left: 14px;
  border-top-left-radius: 2px;
  border-bottom-left-radius: 2px;
}

.btn-txt {
  opacity: 0;
  font-size: 0.75rem;
  color: #3b82f6;
  transition: opacity 0.2s;
}

.add-btn:hover::before,
.add-btn:hover::after {
  width: 4px;
  border-radius: 2px;
}

.add-btn:hover .btn-txt {
  opacity: 1;
}

.add-icon::after,
.add-icon::before {
  transition: all 0.2s ease-in-out;
  content: "";
  position: absolute;
  height: 20px;
  width: 2px;
  top: calc(50% - 10px);
  background: #3b82f6;
}

.add-icon::before {
  left: 22px;
  border-top-left-radius: 2px;
  border-bottom-left-radius: 2px;
}

.add-icon::after {
  right: 22px;
  border-top-right-radius: 2px;
  border-bottom-right-radius: 2px;
}

.add-btn:hover .add-icon::before {
  left: 15px;
  height: 4px;
  top: calc(50% - 2px);
}

.add-btn:hover .add-icon::after {
  right: 15px;
  height: 4px;
  top: calc(50% - 2px);
}

    </style>
    @endpush

    <br>
        <div class="max-w-2xl mx-auto bg-white/80 backdrop-blur-md border border-indigo-200 rounded-3xl shadow-2xl p-8">

            <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-lg font-sans text-gray-800 mb-1">📖 Titel</label>
                    <input type="text" name="title" value="{{ $book->title }}"
                        class="w-full p-3 border border-indigo-300 rounded-xl focus:ring-2 focus:ring-indigo-400 shadow-sm" required>
                </div>

                <div>
                    <label class="block text-lg font-sans text-gray-800 mb-1">📝 Beschrijving</label>
                    <textarea name="description" rows="4"
                        class="w-full p-3 border border-indigo-300 rounded-xl focus:ring-2 focus:ring-indigo-400 shadow-sm">{{ $book->description }}</textarea>
                </div>
<!-- 
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
                </div> -->

                <div>
                    <label class="block text-lg font-sans text-gray-800 mb-1">🎯 AVI Niveau</label>
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


                <!-- Cover Upload -->
<div>
    <label class="block text-lg font-sans text-gray-800 mb-2">🖼️ Huidige omslag</label>
    <img src="{{ asset('storage/' . $book->cover_image) }}" class="h-32 rounded-lg shadow mb-2 border border-indigo-200">
    <label class="icon-btn add-btn add-btn-blue cursor-pointer">
        <input type="file" name="cover_image" class="hidden" onchange="updateLabel(this, 'editCoverLabel')">
        <div class="add-icon"></div>
        <div class="btn-txt" id="editCoverLabel">Nieuwe afbeelding</div>
    </label>
</div>

<!-- PDF Upload -->
<div class="mt-4">
    <label class="block text-lg font-sans text-gray-800 mb-2">📄 Huidige PDF</label>
    <a href="{{ asset('storage/' . $book->pdf_file) }}" target="_blank" class="text-indigo-600 underline text-sm">📂 Bekijk PDF</a><br>
    <label class="icon-btn add-btn add-btn-blue cursor-pointer mt-2">
        <input type="file" name="pdf_file" class="hidden" onchange="updateLabel(this, 'editPdfLabel')">
        <div class="add-icon"></div>
        <div class="btn-txt" id="editPdfLabel">Nieuwe PDF</div>
    </label>
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
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-sans px-6 py-3 rounded-full shadow-md transition transform hover:scale-105 animate-bounce">
                        💾 Boek bijwerken
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
