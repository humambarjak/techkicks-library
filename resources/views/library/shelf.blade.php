<x-app-layout>
    <x-slot name="header">
        <h2>Mijn Shelf</h2>
    </x-slot>

    <div>
        <h1>
            Jouw favoriete boeken
        </h1>

        @if ($earnedBadge)
            <div>
                <span>
                    Super Reader (5+ books read!)
                </span>
            </div>
        @endif

        <div>
            @forelse ($books as $book)
                <div>
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Book Cover">
                    <div>
                        <h3>{{ $book->title }}</h3>
                        <p>{{ Str::limit($book->description, 60) }}</p>

                        <a href="{{ route('library.read', $book) }}">
                            Lezen
                        </a>

                        <form method="POST" action="{{ route('books.favorite', $book) }}">
                            @csrf
                            <button type="submit">
                                Niet meer favoriet
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p>Je hebt nog geen boeken als favoriet gemarkeerd.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
