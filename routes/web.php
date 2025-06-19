<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CustomerBookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('select.role'); // Redirect to role selection page first
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/customer-dashboard', [\App\Http\Controllers\CustomerDashboardController::class, 'index'])->name('customer.dashboard');
});

// Route for customer to browse books
Route::get('/browse', [CustomerBookController::class, 'index'])->name('customer.books');

// Role selection route
Route::get('/select-role', function () {
    return view('auth.select-role');
})->name('select.role');

// Redirect /login to role selection if no role is set
Route::get('/login', function (\Illuminate\Http\Request $request) {
    if (!$request->has('role')) {
        return redirect()->route('select.role');
    }
    return view('auth.login', ['role' => $request->role]);
})->name('login');

// Route for adding books to the cart
Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'view'])->name('cart.view');
Route::post('/cart/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');

require __DIR__.'/auth.php';
