@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card bg-light border-0 shadow-lg">
        <div class="card-body">

            <h2 class="mb-4 text-secondary">
                <i class="bi bi-plus-circle"></i> Add New Book
            </h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('books.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">📖 Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="mb-3">
                    <label for="author_id" class="form-label">✍️ Author</label>
                    <select id="author_id" name="author_id" class="form-control mb-2">
                        <option value="">Select Existing Author</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="new_author" class="form-control" placeholder="Or enter new author name" value="{{ old('new_author') }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">📝 Description (optional)</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">💰 Price ($)</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                </div>

                <div class="mb-3">
                    <label for="genre" class="form-label">🎭 Genre</label>
                    <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre') }}">
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">📦 Stocks</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', 0) }}" min="0">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                        ← Back
                    </a>
                    <button type="submit" class="btn btn-secondary">
                        <i class="bi bi-floppy"></i> Save Book
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
