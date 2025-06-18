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
                    <label for="author" class="form-label">✍️ Author</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">📝 Description (optional)</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">💰 Price ($)</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
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
