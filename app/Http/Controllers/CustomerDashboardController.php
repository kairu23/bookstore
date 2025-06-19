<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->get();
        return view('dashboard.customer', compact('books'));
    }
}
