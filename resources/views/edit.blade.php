@extends('layout')

@section('content')
    <h1>Edit Book</h1>

    @if ($errors->any())
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Title: <input type="text" name="title" value="{{ $book->title }}"></label><br><br>
        <label>Author: <input type="text" name="author" value="{{ $book->author }}"></label><br><br>
        <label>Description: <textarea name="description">{{ $book->description }}</textarea></label><br><br>
        <label>Price: <input type="text" name="price" value="{{ $book->price }}"></label><br><br>

        <button type="submit">Update Book</button>
    </form>
@endsection
