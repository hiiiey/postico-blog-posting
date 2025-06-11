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
    <div class="min-h-screen flex flex-col md:flex-row items-stretch bg-cover bg-center"
        style="background-image: url('{{ asset('images/work-3938876_1280.jpg') }}')">

        <div class="absolute inset-0 bg-black bg-opacity-40"></div>


        <div class="hidden md:flex md:w-1/2 flex-col justify-center p-12 z-10 text-white">
            <div class="animate-fadeIn">
                <div class="text-sm font-semibold uppercase tracking-wider mb-2">Postico</div>
                <h1 class="text-5xl font-bold mb-4 leading-tight">
                    EXPLORE<br>
                    HORIZONS
                </h1>
                <p class="text-lg mb-2">Where your writing dreams become reality.</p>
                <p class="text-sm opacity-80 max-w-md">
                    Embark on a journey where every corner of the blogging world is within your reach.
                    Share your stories, inspire others, and connect with like-minded writers.
                </p>
            </div>
        </div>

        <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-8 z-10">
            <div
                class="w-full max-w-md p-6 md:p-8 bg-white bg-opacity-95 backdrop-blur-sm rounded-lg shadow-lg animate-fadeIn">
                {{ $slot }}
            </div>
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

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
</body>

</html>