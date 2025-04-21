<x-app-layout>
    <x-slot name="header">
        <h2>
            📘 Mijn geüploade boeken
        </h2>
    </x-slot>

    <div>
        <div>
            <div>
                <h3>📚 Boekenlijst</h3>
                <a href="{{ route('books.create') }}">
                    + Nieuw boek uploaden
                </a>
            </div>

            @if($books->count())
                <div>
                    @foreach($books as $book)
                        <div>
                            @if($book->is_special)
                                <span>
                                    ✨ Speciaal
                                </span>
                            @endif

                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover">

                            <h4>
                                {{ $book->title }}
                                @if($book->is_special)
                                    <span>⭐</span>
                                @endif
                            </h4>

                            @if($book->averageRating())
                                <p>
                                    ⭐ {{ $book->averageRating() }} / 5
                                </p>
                            @endif

                            @if($book->created_at->gt(now()->subDays(2)))
                                <span>
                                    🆕 Nieuw
                                </span>
                            @endif

                            <div>
                                <a href="{{ route('books.edit', $book) }}">
                                    ✏️ Bewerking
                                </a>

                                <form action="{{ route('books.destroy', $book) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this book?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        🗑️ Verwijderen
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>📭 You haven't uploaded any books yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>
