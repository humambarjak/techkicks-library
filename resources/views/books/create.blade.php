<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-sans text-center text-indigo-700 mt-4 drop-shadow animate-fade-in-top">
            Nieuw boek uploaden
        </h2>
        <!-- Help Button -->
        <div class="absolute top-6 right-6">
            <button onclick="toggleHelp()" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full shadow-md transition transform hover:scale-110">
                ℹ️
            </button>
        </div>
    </x-slot>

    @push('styles')
    <style>
        header.bg-white {
            background-color: transparent !important;
            box-shadow: none !important;
        }

        @keyframes fadeInTop {
            0% { opacity: 0; transform: translateY(-30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in-top { animation: fadeInTop 0.8s ease-out both; }
        .animate-fade-in-up { animation: fadeInUp 1s ease-out both; }
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
        font-family: inherit;
        display: flex;
        align-items: center;
        justify-content: center;
        }

        .add-btn:hover {
        width: 120px;
        }

        .add-btn::before,
        .add-btn::after {
        transition: width 0.2s ease-in-out, border-radius 0.2s ease-in-out;
        content: "";
        position: absolute;
        height: 4px;
        width: 10px;
        top: calc(50% - 2px);
        background: seagreen;
        }

        .add-btn::after {
        right: 14px;
        border-top-right-radius: 2px;
        border-bottom-right-radius: 2px;
        }

        .add-btn::before {
        left: 14px;
        border-top-left-radius: 2px;
        border-bottom-left-radius: 2px;
        }

        .icon-btn:focus {
        outline: none;
        }

        .btn-txt {
        opacity: 0;
        transition: opacity 0.2s;
        margin-left: 8px;
        white-space: nowrap;
        font-size: 13px;
        color: seagreen;
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
        background: seagreen;
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
    <div class="max-w-xl mx-auto bg-white/80 backdrop-blur-lg border border-indigo-100 rounded-3xl shadow-2xl p-8 animate-fade-in-up relative">
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
                <label class="block text-lg font-sans text-gray-800 mb-1">📖 Boektitel</label>
                <input type="text" name="title" class="w-full p-3 border border-indigo-300 rounded-xl focus:ring-2 focus:ring-indigo-400 shadow-sm" required>
            </div>

            <div>
                <label class="block text-lg font-sans text-gray-800 mb-1">📝 Beschrijving</label>
                <textarea name="description" rows="4" class="w-full p-3 border border-indigo-300 rounded-xl focus:ring-2 focus:ring-indigo-400 shadow-sm"></textarea>
            </div>

            <!-- <div>
                <label class="block text-lg font-semibold text-gray-800 mb-1">📚 Categorie</label>
                <select name="category" class="w-full p-3 border border-indigo-300 rounded-xl focus:ring-2 focus:ring-indigo-400 shadow-sm" required>
                    <option value="">-- Kies een categorie --</option>
                    <option value="Stories">📖 Verhalen</option>
                    <option value="Science">🔬 Wetenschap</option>
                    <option value="Comics">🎨 Strips</option>
                    <option value="Adventure">🧽 Avontuur</option>
                    <option value="History">🏛️ Geschiedenis</option>
                </select>
            </div> -->
            <div>
                <label class="block text-lg font-sans text-gray-800 mb-1">🎯 AVI Niveau</label>
                <select name="level" class="w-full p-3 border border-indigo-300 rounded-xl focus:ring-2 focus:ring-indigo-400 shadow-sm">
                    <option value="">-- Kies een AVI-niveau --</option>
                    <option value="AVI1">AVI 1</option>
                    <option value="AVI2">AVI 2</option>
                    <option value="AVI3">AVI 3</option>
                    <option value="AVI4">AVI 4</option>
                    <option value="AVI5">AVI 5</option>
                    <option value="AVI6">AVI 6</option>
                </select>
            </div>


            <!-- Cover Image Upload -->
            <div>
                <label class="block text-lg font-sans text-gray-800 mb-1">🖼️ Omslagafbeelding</label>
                <label class="icon-btn add-btn cursor-pointer">
                    <input type="file" name="cover_image" class="hidden" onchange="updateLabel(this, 'coverLabel')" required>
                    <div class="add-icon"></div>
                    <div class="btn-txt" id="coverLabel">Afbeelding</div>
                </label>
            </div>

            <!-- PDF File Upload -->
            <div class="mt-4">
                <label class="block text-lg font-sans text-gray-800 mb-1">📄 PDF-bestand</label>
                <label class="icon-btn add-btn cursor-pointer">
                    <input type="file" name="pdf_file" class="hidden" onchange="updateLabel(this, 'pdfLabel')" required>
                    <div class="add-icon"></div>
                    <div class="btn-txt" id="pdfLabel">PDF-bestand</div>
                </label>
            </div>


            <div>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_special" value="1" class="rounded text-indigo-600 transition">
                    <span class="text-sm text-gray-700">✨ Markeer als speciaal boek</span>
                </label>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-sans px-6 py-3 rounded-full shadow-md transition transform hover:scale-105 animate-bounce">
                    🚀 Boek uploaden
                </button>
            </div>
        </form>
    </div>

    <!-- Help Modal -->
    <div id="helpModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-md text-center space-y-4">
            <h2 class="text-2xl font-sans text-indigo-700 mb-2">📚 Boek Upload Instructies</h2>
            <p class="text-gray-700 text-sm">Vul alle verplichte velden in zoals titel, categorie en omslagafbeelding. Upload daarna het PDF-bestand en klik op "🚀 Boek uploaden".</p>
            <p class="text-gray-500 text-xs">Alle boeken worden automatisch opgeslagen in jouw bibliotheek!</p>
            <button onclick="toggleHelp()" class="mt-4 bg-indigo-500 hover:bg-indigo-600 text-white font-sans px-6 py-2 rounded-full shadow-md">Gelezen</button>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleHelp() {
            const modal = document.getElementById('helpModal');
            modal.classList.toggle('hidden');
        }
    </script>
    @endpush
</x-app-layout>