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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all(); // show all books for testing
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'pdf_file' => 'required|mimes:pdf|max:10000',
            'category' => 'required|in:Stories,Science,Comics,Adventure,History',
        ]);
    
        // ✅ Log full request
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
            'is_special' => $request->has('is_special'), // ✅ relies on checkbox existing
        ]);
        if ($book->is_special) {
            \Log::info('✅ Book is saved as SPECIAL');
        } else {
            \Log::info('❌ Book is NOT marked special');
        }
        
    
        \Log::info('📚 Book created:', $book->toArray());
    
        return redirect()->route('books.index')->with('success', 'Book uploaded successfully!');
    }
    


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    // special books
    public function special(Request $request)
{
    $query = \App\Models\Book::where('is_special', true); // ✅ only special books

    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    $books = $query->paginate(9); // pagination

    $categories = \App\Models\Book::where('is_special', true)
        ->select('category')
        ->distinct()
        ->pluck('category');

    return view('library.special', compact('books', 'categories'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id); // ✅ fetch the book from DB
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $book = Book::findOrFail($id);

    $data = $request->only(['title', 'description', 'category']);

    if ($request->hasFile('cover_image')) {
        $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
    }

    if ($request->hasFile('pdf_file')) {
        $data['pdf_file'] = $request->file('pdf_file')->store('pdfs', 'public');
    }

    $data['is_special'] = $request->has('is_special'); // ✅ THIS LINE ADDED

    $book->update($data);

    return redirect()->route('books.index')->with('success', 'Book updated!');
}


    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ✅ Fetch the book by its ID first
        $book = Book::findOrFail($id);

        // ✅ Optional: check if the logged-in user owns this book
        if ($book->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // ✅ Delete files from storage
        Storage::disk('public')->delete($book->cover_image);
        Storage::disk('public')->delete($book->pdf_file);

        // ✅ Delete the record
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }

        // For students: show all books in colorful grid
        public function studentIndex(Request $request)
{
    $bookOfTheDay = Book::inRandomOrder()->first();

    $query = Book::where('is_special', false); // ✅ filters only regular books

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

    // ✅ Attach the book if not already tracked
    if (! $user->books_read()->where('book_id', $book->id)->exists()) {
        $user->books_read()->attach($book->id, [
            'last_page' => 1 // 👉 You can use 1 as default
        ]);
    } else {
        // ✅ Update progress (this is just an example — you'll make it dynamic later)
        $user->books_read()->updateExistingPivot($book->id, [
            'last_page' => 5 // 🔁 Replace with real page later
        ]);
    }

    // ✅ Fetch user notes
    $notes = $book->notes()
        ->where('user_id', $user->id)
        ->get(['page', 'content']);

    return view('library.reader', compact('book', 'notes'));
}


    // public function studentProgress()
    // {
    //     // Get all students with the books they read
    //     $students = User::where('role', 'student')
    //         ->with('books_read')
    //         ->get();

    //     return view('teacher.student-progress', compact('students'));
    // }
    // NEW PROGRESS
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
