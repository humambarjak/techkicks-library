<x-app-layout>
    <x-slot name="header">
        <h2>
            ✨ Nieuw boek uploaden
        </h2>
    </x-slot>

    <div>
        <div>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                @csrf

                <div>
                    <label>📖 Boektitel</label>
                    <input type="text" name="title" required>
                </div>

                <div>
                    <label>📝 Beschrijving</label>
                    <textarea name="description" rows="4"></textarea>
                </div>

                <div>
                    <label>📚 Categorie</label>
                    <select name="category" required>
                        <option value="">-- Kies een categorie --</option>
                        <option value="Stories">📖 Verhalen</option>
                        <option value="Science">🔬 Wetenschap</option>
                        <option value="Comics">🎨 Strips</option>
                        <option value="Adventure">🧭 Avontuur</option>
                        <option value="History">🏛️ Geschiedenis</option>
                    </select>
                </div>

                <div>
                    <label>🖼️ Omslagafbeelding</label>
                    <input type="file" name="cover_image" required>
                </div>

                <div>
                    <label>📄 PDF-bestand</label>
                    <input type="file" name="pdf_file" required>
                </div>

                <div>
                    <label>
                        <input type="checkbox" name="is_special" value="1">
                        <span>✨ Markeer als speciaal boek</span>
                    </label>
                </div>

                <div>
                    <button type="submit">
                        🚀 Boek uploaden
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
