<x-app-layout>
    <x-slot name="header">
        <h2>
            Boek bewerken
        </h2>
    </x-slot>

    <div>
        <div>
            <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div>
                    <label>Titel</label>
                    <input type="text" name="title" value="{{ $book->title }}" required>
                </div>

                <div>
                    <label>Beschrijving</label>
                    <textarea name="description" rows="4">{{ $book->description }}</textarea>
                </div>

                <div>
                    <label>Categorie</label>
                    <select name="category" required>
                        <option value="">-- Kies een categorie --</option>
                        <option value="Stories" {{ $book->category == 'Stories' ? 'selected' : '' }}>Verhalen</option>
                        <option value="Science" {{ $book->category == 'Science' ? 'selected' : '' }}>Wetenschap</option>
                        <option value="Comics" {{ $book->category == 'Comics' ? 'selected' : '' }}>Strips</option>
                        <option value="Adventure" {{ $book->category == 'Adventure' ? 'selected' : '' }}>Avontuur</option>
                        <option value="History" {{ $book->category == 'History' ? 'selected' : '' }}>Geschiedenis</option>
                    </select>
                </div>

                <div>
                    <label>Huidige omslag</label>
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Omslagafbeelding">
                    <input type="file" name="cover_image">
                </div>

                <div>
                    <label>Huidige PDF</label>
                    <a href="{{ asset('storage/' . $book->pdf_file) }}" target="_blank">Bekijk PDF</a><br>
                    <input type="file" name="pdf_file">
                </div>

                <div>
                    <label>
                        <input type="checkbox" name="is_special" value="1" {{ $book->is_special ? 'checked' : '' }}>
                        <span>Markeer als speciaal boek</span>
                    </label>
                </div>

                <div>
                    <button type="submit">
                        Boek bijwerken
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
