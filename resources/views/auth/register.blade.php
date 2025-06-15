{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="usertype" value="{{ __('User Type') }}" />
                <select id="usertype" class="block mt-1 w-full" name="usertype" required>
                    <option value="user" {{ old('usertype') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="ownersalon" {{ old('usertype') == 'ownersalon' ? 'selected' : '' }}>Salon</option>
                </select>
            </div>

            <div class="mt-4">
                <x-label for="name" value="{{ __('Phone') }}" />
                <x-input id="name" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Sudah daftar?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register GlamVerse</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-[#e3e3e3] min-h-screen flex items-center justify-center p-6">
    <div class="flex flex-col md:flex-row items-center justify-center w-full max-w-6xl gap-20">

        {{-- Logo kiri --}}
        <div class="w-full md:w-1/2 flex justify-center">
            <img src="{{ asset('pictures/logobig.png') }}" alt="GlamVerse Logo" class="w-64" />
        </div>

        {{-- Form kanan --}}
        <form method="POST" action="{{ route('register') }}" class="bg-[#7d4f67] text-white rounded-xl p-10 w-full max-w-md shadow-lg">
            @csrf

            {{-- Error Display --}}
            @if ($errors->any())
                <div class="mb-4 text-sm text-red-300">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1 class="text-3xl font-semibold mb-8">Buat Akun</h1>

            {{-- Name --}}
            <div class="mb-4">
                <label class="block mb-1" for="name">Nama</label>
                <input name="name" id="name" type="text" value="{{ old('name') }}" required
                    class="w-full rounded-md p-2 text-gray-900 placeholder-gray-500 focus:outline-none"
                    placeholder="Nama">
            </div>

            {{-- Phone --}}
            <div class="mb-4">
                <label class="block mb-1" for="phone">No Handphone</label>
                <span class="text-xs text-gray-400">Wajib dengan format 62xxxx</span>
                <input name="phone"  type="tel" value="{{ old('phone') }}" required
                    class="w-full rounded-md p-2 text-gray-900 placeholder-gray-500 focus:outline-none"
                    placeholder="No. Handphone">
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block mb-1" for="email">Email</label>
                <input name="email" id="email" type="email" value="{{ old('email') }}" required
                    class="w-full rounded-md p-2 text-gray-900 placeholder-gray-500 focus:outline-none"
                    placeholder="Email">
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label class="block mb-1" for="password">Password</label>
                <input name="password" id="password" type="password" required
                    class="w-full rounded-md p-2 text-gray-900 placeholder-gray-500 focus:outline-none"
                    placeholder="Password">
            </div>

            {{-- Confirm Password --}}
            <div class="mb-4">
                <label class="block mb-1" for="password_confirmation">Konfirmasi Password</label>
                <input name="password_confirmation" id="password_confirmation" type="password" required
                    class="w-full rounded-md p-2 text-gray-900 placeholder-gray-500 focus:outline-none"
                    placeholder="Konfirmasi Password">
            </div>

            {{-- Usertype --}}
            <div class="mb-6">
                <label class="block mb-1" for="usertype">Usertype</label>
                <select name="usertype" id="usertype" required
                    class="w-full rounded-md p-2 text-gray-900 focus:outline-none">
                    <option disabled selected hidden>usertype</option>
                    <option value="user" {{ old('usertype') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="ownersalon" {{ old('usertype') == 'ownersalon' ? 'selected' : '' }}>Salon</option>
                </select>
            </div>

            {{-- Button --}}
            <button type="submit"
                class="bg-[#3b172d] w-full py-3 rounded-md font-semibold hover:bg-[#2a0f21] transition">
                Register
            </button>

            <p class="text-center mt-6 text-sm">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-bold underline text-white">Login Sekarang!</a>
            </p>
        </form>
    </div>
</body>
</html>




