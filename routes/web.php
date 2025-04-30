<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use App\Models\JournalEntry;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/info', function () {
    return view('pages.info');
})->name('info.page');

// 🎮 GAMES
Route::get('/game', function () {
    return view('pages.game');
})->name('library.game');

Route::get('/emoji', function () {
    return view('pages.emoji');
})->name('library.emoji');

Route::get('/games/menu', function () {
    return view('pages.games-menu');
})->name('library.games');
Route::view('/race', 'pages.race')->name('race');
Route::get('/typing-battle', function () {
    return view('pages.typing-battle');
})->name('typing.battle');

Route::get('/games-menu', function () {
    return view('pages.games-menu');
})->name('games-menu');

Route::get('/library/special', [BookController::class, 'special'])
    ->name('library.special')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Dashboard (only for logged-in users)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    $user = Auth::user();
    $today = now()->toDateString();
    $yesterday = now()->subDay()->toDateString();

    $lastReadDate = optional($user->last_read_at)->toDateString();
    $currentStreak = $user->reading_streak ?? 0;

    if ($lastReadDate === $today) {
        $streakDays = $currentStreak;
    } elseif ($lastReadDate === $yesterday) {
        $streakDays = $currentStreak + 1;
        $user->update([
            'reading_streak' => $streakDays,
            'last_read_at' => now(),
        ]);
    } else {
        $streakDays = 1;
        $user->update([
            'reading_streak' => 1,
            'last_read_at' => now(),
        ]);
    }

    // ✅ Add this to fetch past journal entries
    $journalEntries = JournalEntry::where('user_id', $user->id)
        ->orderByDesc('date')
        ->take(30)
        ->get();

    return view('dashboard', compact('streakDays', 'journalEntries'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/save-journal', function (Request $request) {
    JournalEntry::create([
        'user_id' => auth()->id(),
        'content' => $request->input('content'),
        'date' => now(),
    ]);

    return response()->json(['success' => true]);
})->middleware('auth')->name('journal.save');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::aliasMiddleware('role', RoleMiddleware::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/library', [BookController::class, 'studentIndex'])->name('library.index');
    Route::get('/library/shelf', [BookController::class, 'myShelf'])->name('library.shelf');
    Route::get('/library/{book}', [BookController::class, 'read'])->name('library.read');
    Route::post('/books/{book}/favorite', [BookController::class, 'toggleFavorite'])->name('books.favorite');
    Route::post('/notes', [NoteController::class, 'store']);
    Route::post('/books/{book}/rate', [BookController::class, 'rate'])->name('books.rate');
});

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('/books/{book}/view', [BookController::class, 'view'])->name('books.view');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/progress', [BookController::class, 'studentProgress'])->name('teacher.progress');
});

Route::get('/teacher/progress', [BookController::class, 'progress'])
    ->name('teacher.progress')
    ->middleware(['auth', 'role:teacher']);

/*
|--------------------------------------------------------------------------
| Auth Scaffolding
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
