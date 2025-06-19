@extends('layouts.app')

@section('header')
    <h2 class="h4">📚 Book List</h2>
@endsection

@section('content')
    <form method="GET" action="{{ route('books.index') }}" class="row g-3 mb-4 align-items-center">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by title or author..." value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <select name="author_id" class="form-select" required>
                <option value="">Filter by author</option>
                @foreach($authors as $a)
                    <option value="{{ $a->id }}" {{ request('author') == $a->id ? 'selected' : '' }}>{{ $a->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="sort" class="form-select">
                <option value="">Sort by</option>
                <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title (A-Z)</option>
                <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title (Z-A)</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100" type="submit">Apply</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">➕ Add New Book</a>

    @if($books->isEmpty())
        <div class="alert alert-info">No books found.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author ? $book->author->name : '' }}</td>
                    <td>${{ $book->price }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this book?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
