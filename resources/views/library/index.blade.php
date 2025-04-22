<x-app-layout>
    <x-slot name="header">
        <h2></h2>
    </x-slot>

    <div>
        <h1>
            Welkom, {{ Auth::user()->name }}! Laten we lezen!
        </h1>

        {{-- Category Filter --}}
        <form method="GET" action="{{ route('library.index') }}">
            <label for="category">Filter op categorie:</label>
            <select name="category" onchange="this.form.submit()">
                <option value="">Alle categorieën</option>
                <option value="Stories" {{ $selectedCategory == 'Stories' ? 'selected' : '' }}>AVI 1</option>
                <option value="Science" {{ $selectedCategory == 'Science' ? 'selected' : '' }}>AVI 2</option>
                <option value="Comics" {{ $selectedCategory == 'Comics' ? 'selected' : '' }}>AVI 3</option>
                <option value="Adventure" {{ $selectedCategory == 'Adventure' ? 'selected' : '' }}>AVI 4</option>
                <option value="History" {{ $selectedCategory == 'History' ? 'selected' : '' }}>AVI 5</option>
            </select>
        </form>

        {{-- Book Grid --}}
        <div>
            @foreach($books as $book)
                <div>
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Book Cover">
                    <div>
                        @if (isset($bookOfTheDay) && $book->id === $bookOfTheDay->id)
                            <span>
                                Boek van de dag
                            </span>
                        @endif

                        <h3>{{ $book->title }}</h3>
                        <p>{{ Str::limit($book->description, 60) }}</p>

                        <a href="{{ route('library.read', $book) }}">
                            Lezen
                        </a>

                        @if($book->averageRating())
                            <p>
                                Gemiddelde beoordeling:
                                {{ str_repeat('*', floor($book->averageRating())) }}
                                <span>({{ $book->averageRating() }}/5)</span>
                            </p>
                        @endif

                        <form method="POST" action="{{ route('books.favorite', $book) }}">
                            @csrf
                            <button type="submit">
                                {{ auth()->user()->favoriteBooks->contains($book) ? 'Niet meer favoriet' : 'Favoriet' }}
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        @if($books->isEmpty())
            <p>Geen boeken gevonden in deze categorie.</p>
        @endif
    </div>
</x-app-layout>
