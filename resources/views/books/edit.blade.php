@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-body bg-light rounded px-4 py-5">

            <h2 class="mb-4 text-secondary">
                <i class="bi bi-pencil-square"></i> Edit Book
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

            <form method="POST" action="{{ route('books.update', $book->id) }}">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">📖 Title</label>
                    <input id="title" name="title" type="text" class="form-control" value="{{ old('title', $book->title) }}" required>
                </div>

                <!-- Author -->
                <div class="mb-3">
                    <label for="author_id" class="form-label">✍️ Author</label>
                    <select id="author_id" name="author_id" class="form-control mb-2">
                        <option value="">Select Existing Author</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ old('author_id', $book->author_id ?? '') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="new_author" class="form-control" placeholder="Or enter new author name" value="{{ old('new_author') }}">
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">📝 Description (optional)</label>
                    <textarea id="description" name="description" rows="3" class="form-control">{{ old('description', $book->description) }}</textarea>
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <label for="price" class="form-label">💰 Price ($)</label>
                    <input id="price" name="price" type="number" step="0.01" class="form-control" value="{{ old('price', $book->price) }}" required>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                        ← Back
                    </a>
                    <button type="submit" class="btn btn-secondary">
                        <i class="bi bi-save2"></i> Update Book
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
