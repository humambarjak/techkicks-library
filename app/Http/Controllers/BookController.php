<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'pdf_file' => 'required|mimes:pdf|max:10000',
            'category' => 'required|in:Stories,Science,Comics,Adventure,History',
        ]);

        \Log::info('🪵 Full request payload:', $request->all());

        $coverPath = $request->file('cover_image')->store('covers', 'public');
        $pdfPath = $request->file('pdf_file')->store('pdfs', 'public');

        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'cover_image' => $coverPath,
            'pdf_file' => $pdfPath,
            'user_id' => auth()->id(),
            'category' => $request->category,
            'is_special' => $request->has('is_special'),
            'level' => $request->level,
        ]);

        \Log::info($book->is_special ? '✅ Book is saved as SPECIAL' : '❌ Book is NOT marked special');
        \Log::info('📚 Book created:', $book->toArray());

        return redirect()->route('books.index')->with('success', 'Book uploaded successfully!');
    }

    public function show(string $id)
    {
        //
    }

    public function special(Request $request)
    {
        $query = Book::where('is_special', true);

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $books = $query->paginate(9);

        $categories = Book::where('is_special', true)
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('library.special', compact('books', 'categories'));
    }

    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->only(['title', 'description', 'category', 'level']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $data['pdf_file'] = $request->file('pdf_file')->store('pdfs', 'public');
        }

        $data['is_special'] = $request->has('is_special');

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Book updated!');
    }

    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        if ($book->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        Storage::disk('public')->delete($book->cover_image);
        Storage::disk('public')->delete($book->pdf_file);

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }

    public function studentIndex(Request $request)
    {
        $bookOfTheDay = Book::inRandomOrder()->first();

        $query = Book::where('is_special', false);

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $books = $query->get();
        $selectedCategory = $request->category;

        return view('library.index', compact('books', 'bookOfTheDay', 'selectedCategory'));
    }

    public function read(Book $book)
    {
        $user = auth()->user();

        // ✅ Reading streak logic
        $today = now()->toDateString();
        $yesterday = now()->subDay()->toDateString();
        $lastRead = optional($user->last_read_at)->toDateString();
        $streak = $user->reading_streak ?? 0;

        if ($lastRead === $today) {
            // no change
        } elseif ($lastRead === $yesterday) {
            $user->update([
                'reading_streak' => $streak + 1,
                'last_read_at' => now(),
            ]);
        } else {
            $user->update([
                'reading_streak' => 1,
                'last_read_at' => now(),
            ]);
        }

        if (!$user->books_read()->where('book_id', $book->id)->exists()) {
            $user->books_read()->attach($book->id, ['last_page' => 1]);
        } else {
            $user->books_read()->updateExistingPivot($book->id, ['last_page' => 5]);
        }

        $notes = $book->notes()->where('user_id', $user->id)->get(['page', 'content']);

        return view('library.reader', compact('book', 'notes'));
    }

    public function view(Book $book)
    {
        return view('teacher.read', compact('book'));
    }

    public function progress(Request $request)
    {
        $query = User::where('role', 'student')->withCount('books_read');

        if ($request->has('search') && $request->search !== '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort') && $request->sort === 'most') {
            $query->orderByDesc('books_read_count');
        } elseif ($request->has('sort') && $request->sort === 'least') {
            $query->orderBy('books_read_count');
        }

        $students = $query->with('books_read')->get();

        return view('teacher.student-progress', compact('students'));
    }

    public function toggleFavorite(Book $book)
    {
        $user = auth()->user();

        if ($user->favoriteBooks()->where('book_id', $book->id)->exists()) {
            $user->favoriteBooks()->detach($book->id);
        } else {
            $user->favoriteBooks()->attach($book->id);
        }

        return back();
    }

    public function myShelf()
    {
        \Log::info('✅ Reached MyShelf!');

        $user = auth()->user();
        $books = $user->favoriteBooks;
        $booksReadCount = $user->books_read()->count();
        $earnedBadge = $booksReadCount >= 5;

        return view('library.shelf', compact('books', 'earnedBadge'));
    }

    public function rate(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $user = auth()->user();

        $user->ratings()->updateOrCreate(
            ['book_id' => $book->id],
            ['rating' => $request->rating]
        );

        return back()->with('success', 'Dank je voor je beoordeling!');
    }
}
