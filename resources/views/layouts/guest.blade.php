<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .auth-wrapper {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            background-color: rgba(0, 0, 0, 0.4);
            padding: 3rem;
            border-radius: 16px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
            color: #fff;
        }

        .auth-wrapper input,
        .auth-wrapper label {
            color: #fff !important;
        }

        .auth-wrapper input {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .auth-wrapper a {
            color: #cce7ff;
        }

        .auth-wrapper a:hover {
            text-decoration: underline;
        }

        .auth-wrapper .btn {
            background-color: #007bff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            color: white;
            font-weight: 600;
        }

        .auth-wrapper .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 auth-wrapper">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
