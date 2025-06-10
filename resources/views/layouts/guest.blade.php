<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Postico') }}</title>

    <link rel="icon" href="{{ asset('postico.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white">

        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-gray-100 rounded-full mix-blend-multiply filter blur-xl opacity-10">
            </div>
            <div
                class="absolute -bottom-40 -left-40 w-80 h-80 bg-gray-200 rounded-full mix-blend-multiply filter blur-xl opacity-10">
            </div>
        </div>

        <div>
            <a href="/" class="group transform transition-all duration-300 hover:scale-110">
                <img src="{{ asset('postico.png') }}" alt="Postico" class="w-20 h-20">
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white border border-gray-200 hover:border-gray-300 shadow-sm hover:shadow-md transition-all duration-300 rounded-lg group transform hover:-translate-y-1">
            {{ $slot }}
        </div>

        <div class="mt-8 text-center text-gray-500">
            <p>&copy; 2024 Postico. All rights reserved.</p>
        </div>
    </div>

    <style>
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .animate-gradient {
            animation: gradient 3s ease infinite;
        }
    </style>
</body>

</html>