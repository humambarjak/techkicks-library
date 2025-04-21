<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\NoteController;

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

Route::get('/library/special', [BookController::class, 'special'])
    ->name('library.special')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Dashboard (only for logged-in users)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    // Add this line:
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
