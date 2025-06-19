@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-body bg-light rounded px-4 py-5 text-center">
                    <h2 class="mb-4 text-secondary">Who are you?</h2>
                    <a href="{{ route('login', ['role' => 'customer']) }}" class="btn btn-primary btn-lg mb-3 w-100">Customer</a>
                    <a href="{{ route('login', ['role' => 'admin']) }}" class="btn btn-dark btn-lg w-100">Admin</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
