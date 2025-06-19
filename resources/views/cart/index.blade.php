@extends('layouts.app')

@section('header')
    <h2 class="h4">🛒 Your Cart</h2>
@endsection

@section('content')
    @if(empty($books))
        <div class="alert alert-info">Your cart is empty.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author ? $book->author->name : '' }}</td>
                    <td>{{ $book->genre }}</td>
                    <td>{{ $book->cart_quantity }}</td>
                    <td>${{ $book->price }}</td>
                    <td>${{ number_format($book->price * $book->cart_quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mb-3 text-end">
            <strong>Total: ${{ number_format($total, 2) }}</strong>
        </div>
        <form method="POST" action="{{ route('cart.checkout') }}">
            @csrf
            <button class="btn btn-success">Checkout</button>
        </form>
    @endif
@endsection
