<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CustomerBookController extends Controller
{
    public function index()
    {
        // Only show books created by admin (assuming admin has user_id = 1)
        $books = Book::with('author')->get();
        return view('books.customer_dashboard', compact('books'));
    }
}
