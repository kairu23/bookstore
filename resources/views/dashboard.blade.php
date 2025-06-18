@extends('layouts.app')

@section('content')
    <style>
       body {
        background: url("{{ asset('img/bookshelf.jpeg') }}") no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
    }

        .dashboard-container {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.75);
            padding: 2rem;
            border-radius: 16px;
            margin: 2rem auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
    </style>

    <div class="dashboard-container">
        <h2 class="font-semibold text-2xl text-gray-900 dark:text-white mb-4">
            📚 Dashboard
        </h2>

        <div class="p-6 text-gray-900 dark:text-gray-100">
            {{ __("You're logged in!") }}
        </div>
    </div>
@endsection
