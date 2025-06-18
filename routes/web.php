<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/books'); // Redirect to /books instead of welcome page
});

Route::get('/dashboard', function () {
    return redirect('/books'); // Optional: redirect dashboard to books
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Protect all book and profile routes under auth
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ Book routes
    Route::resource('books', BookController::class);
     // ✅ Additional route for creating book from dashboard
    Route::post('/dashboard/books', [BookController::class, 'store'])->name('dashboard.books.store');
});

require __DIR__.'/auth.php';
