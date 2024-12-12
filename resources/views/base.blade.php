<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mon Application')</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
<!-- Navbar -->
@include('navbar')

<!-- Main Content -->
<main class="">
    @yield('content')
</main>

<!-- Footer -->
<footer class=" text-black mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 text-center">
        &copy; {{ date('Y') }} Mon Application. Tous droits réservés.
    </div>
</footer>
</body>
</html>
