@extends('layouts.app')

@section('header')
    <h2 class="h4">📚 Browse Books</h2>
@endsection

@section('content')
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
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
