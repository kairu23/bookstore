@extends('layouts.app')

@section('header')
    <h2 class="h4">📚 Customer Dashboard</h2>
@endsection

@section('content')
    <div class="mb-4">
        <h5 style="color: white;">Welcome, {{ auth()->user()->name }}!</h5>
        <p style="color: white;">Browse books available from the bookstore below.</p>
    </div>
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    @if($books->isEmpty())
        <div class="alert alert-info">No books available.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Stocks</th>
                    <th>Price</th>
                    <th>Add to Cart</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author ? $book->author->name : '' }}</td>
                    <td>{{ $book->genre }}</td>
                    <td>{{ $book->quantity }}</td>
                    <td>${{ $book->price }}</td>
                    <td>
                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button class="btn btn-sm btn-success" type="submit">Add to Cart</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
