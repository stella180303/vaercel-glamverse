{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login GlamVerse</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-[#e3e3e3] min-h-screen flex items-center justify-center p-6">
    <div class="flex flex-col md:flex-row items-center justify-center w-full max-w-6xl gap-20">
        
        {{-- Logo Kiri --}}
        <div class="w-full md:w-1/2 flex justify-center">
            <img src="{{ asset('pictures/logobig.png') }}" alt="GlamVerse Logo" class="w-64" />
        </div>

        @if ($errors->any())
            <div class="mb-4 text-red-500 text-sm">
                @foreach ($errors->all() as $error)
                    <p>- {{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Form Login --}}
        <form method="POST" action="{{ route('login') }}" class="bg-[#7d4f67] text-white rounded-xl p-10 w-full max-w-md shadow-lg">
            @csrf
            {{-- Validation --}}
           
            @if ($errors->any())
                <div class="mb-4 text-sm text-red-300">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h2 class="text-3xl font-bold mb-8">Login</h2>

            <div class="mb-4">
                <label class="block mb-1">Email</label>
                <input type="email" name="email" required value="{{ old('email') }}" class="w-full p-3 rounded-md text-gray-800 placeholder-gray-500" placeholder="Email">
            </div>

            <div class="mb-6">
                <label class="block mb-1">Password</label>
                <input type="password" name="password" required class="w-full p-3 rounded-md text-gray-800 placeholder-gray-500" placeholder="Password">
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600" />
                    <span class="ml-2 text-sm text-white">Remember me</span>
                </label>
            </div>

            <div class="text-right mb-4">
                <a href="{{ route('password.request') }}" class="text-sm text-white underline hover:text-gray-300">
                    Lupa password?
                </a>
            </div>

            <button type="submit"
                    class="bg-[#3b172d] w-full py-3 rounded-md font-semibold hover:bg-[#2a0f21] transition">
                Login
            </button>

            <p class="text-center mt-6 text-sm">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-bold underline text-white">Buat Sekarang!</a>
            </p>

            
        </form>
    </div>
</body>
</html>





