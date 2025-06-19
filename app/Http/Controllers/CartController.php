<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);
        $book = Book::findOrFail($request->book_id);
        if ($book->quantity < 1) {
            return back()->with('error', 'Sorry, this book is out of stock.');
        }
        $cart = session()->get('cart', []);
        $bookId = $request->book_id;
        if (isset($cart[$bookId])) {
            $cart[$bookId]++;
        } else {
            $cart[$bookId] = 1;
        }
        session(['cart' => $cart]);
        $book->decrement('quantity');
        return back()->with('success', 'Book added to cart and stock reduced!');
    }

    public function view()
    {
        $cart = session('cart', []);
        $books = [];
        $total = 0;
        foreach ($cart as $bookId => $qty) {
            $book = \App\Models\Book::find($bookId);
            if ($book) {
                $book->cart_quantity = $qty;
                $books[] = $book;
                $total += $book->price * $qty;
            }
        }
        return view('cart.index', compact('books', 'total'));
    }

    public function checkout()
    {
        session()->forget('cart');
        return redirect()->route('customer.dashboard')->with('success', 'Checkout complete! Thank you for your purchase.');
    }
}
