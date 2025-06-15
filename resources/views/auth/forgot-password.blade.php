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

        {{-- Form Reuqest --}}
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession

            <x-validation-errors class="mb-4" />

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-2 mb-4 h-10 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </div>
</body>
</html>