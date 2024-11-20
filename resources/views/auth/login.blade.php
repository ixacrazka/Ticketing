<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <x-guest-layout>
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
            <!-- Icon Orang -->
            <div class="flex justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-indigo-600">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A3.75 3.75 0 0012 1.5a3.75 3.75 0 00-3.75 3.75V9m11.25 0a3 3 0 01-3 3H7.5a3 3 0 01-3-3m11.25 0H4.5M19.5 22.5v-2.25a4.5 4.5 0 00-4.5-4.5h-6a4.5 4.5 0 00-4.5 4.5v2.25" />
                </svg>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Masukan Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                  type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Masukan Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                  type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- CAPTCHA -->
                <div class="mt-2 mb-2">
                        <div class="captcha flex flex-wrap">
                            <span id="captcha_image" class="me-2">{!! captcha_img('math') !!}</span>
                            <button type="button" class="bg-primary rounded-lg text-white px-5 py-2"
                                id="reload">&#x21bb;</button>
                        </div>
                    </div>

                    <div class="mt-2 mb-2">
                        <x-text-input type="text" class="w-full" placeholder="Masukkan Captcha" name="captcha"
                            required></x-text-input>
                        @error('captcha')
                            <label for="" class="text-red-600">{{ $message }}</label>
                        @enderror
                    </div>

                <!-- Actions -->
                <div class="flex items-center justify-between mt-4">
                    <x-primary-button class="ml-3 bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 text-white px-4 py-2 rounded-md shadow-md">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Register Button -->
        </div>
    </x-guest-layout>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: '/reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha)
                }
            });
        });
    </script>

</body>
</html>
