<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
public function index(Request $request)
{
    $search = $request->query('search');
    $author = $request->query('author');
    $sort   = $request->query('sort'); // title_asc, title_desc, price_asc, etc.

    $books = Book::query();

    if ($search) {
        $books->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%");
        });
    }

    if ($author) {
        $books->where('author', $author);
    }

    if ($sort === 'title_asc') {
        $books->orderBy('title', 'asc');
    } elseif ($sort === 'title_desc') {
        $books->orderBy('title', 'desc');
    } elseif ($sort === 'price_asc') {
        $books->orderBy('price', 'asc');
    } elseif ($sort === 'price_desc') {
        $books->orderBy('price', 'desc');
    }

    $books = $books->get();
    $authors = Book::select('author')->distinct()->pluck('author');

    return view('books.index', compact('books', 'search', 'author', 'sort', 'authors'));
}


    public function create() {
        return view('books.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
        ]);

        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Book added!');
    }

    public function edit(Book $book) {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book) {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
        ]);

        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Book updated!');
    }

    public function destroy(Book $book) {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted!');
    }
}