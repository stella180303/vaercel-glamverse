<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>
<body class="font-sans antialiased bg-gray-100">

    <!-- Navigasi -->
    <nav class="mb-4">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="space-x-4">
                @auth
                    @if(Auth::user()->usertype === 'admin')
                        <a href="{{ url('/admin') }}" class="text-gray-700 hover:text-purple-700" style="margin:10px;">Dashboard Admin</a>
                        <a href="{{ url('/admin/bookings') }}" class="text-gray-700 hover:text-purple-700" style="margin:10px;">List Booking</a>
                    @elseif(Auth::user()->usertype === 'ownersalon')
                        <a href="{{ url('/ownersalon') }}" class="text-gray-700 hover:text-purple-700" style="margin:10px;">Dashboard Owner</a>
                    @else
                        <span class="text-sm text-gray-600 ml-4">Halo, {{ Auth::user()->name }} 👋</span>
                    @endif

                    {{-- Tombol Logout--}}
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-yellow-600 hover:text-red-500" style="margin:10px;">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-purple-700" style="margin:10px;">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-purple-700" style="margin:10px;">Register</a>
                @endauth
            </div>
        </div>
    </nav>


    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="px-4 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>

</body>
</html>
    