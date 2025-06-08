<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Postico') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('postico.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Medium-like fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Medium styling -->
    <style>
        /* Charter font for body text */
        .font-serif {
            font-family: "Charter", "Georgia", "Cambria", "Times New Roman", "Times", serif;
        }

        /* Medium uses a sans-serif font for titles */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .post-title,
        .medium-title {
            font-family: "sohne", "Helvetica Neue", "Arial", sans-serif;
            letter-spacing: -0.022em;
            font-weight: 800;
            font-size: 2rem;
        }

        h1,
        .post-title {
            font-size: 2.25rem;
        }

        @media (min-width: 768px) {

            h1,
            .post-title {
                font-size: 2.5rem;
            }
        }

        /* For bold text */
        strong,
        b {
            font-size: 1.5rem;
            font-weight: 800;
        }

        /* Medium-style layout */
        body {
            letter-spacing: -0.003em;
            line-height: 1.58;
            font-size: 16px;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white pt-16">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('scripts')
</body>

</html>