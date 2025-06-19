<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
public function index(Request $request)
{
    $search = $request->query('search');
    $author = $request->query('author');
    $sort   = $request->query('sort');

    $books = Book::with('author');

    if ($search) {
        $books->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%");
        });
        $books->orWhereHas('author', function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
        });
    }

    if ($author) {
        $books->where('author_id', $author);
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
    $authors = Author::all();

    return view('books.index', compact('books', 'search', 'author', 'sort', 'authors'));
}

    public function create() {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'genre' => 'nullable|string',
            'quantity' => 'nullable|integer',
        ]);

        $authorId = $request->author_id;
        if ($request->filled('new_author')) {
            $author = Author::firstOrCreate(['name' => $request->new_author]);
            $authorId = $author->id;
        }

        Book::create([
            'title' => $request->title,
            'author_id' => $authorId,
            'genre' => $request->genre,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        return redirect()->route('books.index')->with('success', 'Book added!');
    }

    public function edit(Book $book) {
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    public function update(Request $request, Book $book) {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
        ]);

        $authorId = $request->author_id;
        if ($request->filled('new_author')) {
            $author = Author::firstOrCreate(['name' => $request->new_author]);
            $authorId = $author->id;
        }

        $book->update([
            'title' => $request->title,
            'author_id' => $authorId,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        return redirect()->route('books.index')->with('success', 'Book updated!');
    }

    public function destroy(Book $book) {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted!');
    }
}