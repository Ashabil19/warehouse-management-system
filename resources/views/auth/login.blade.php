<x-guest-layout>
    <form method="POST" action="{{ route('login') }}" class="w-full max-w-md space-y-6">
        @csrf
        <h2 class="text-3xl font-bold text-purple-800">LOGIN</h2>
        <p class="text-sm text-gray-600">Welcome to GudangEasy, Please login to your account!</p>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Username')" />
            <div class="relative">
                <x-text-input id="email" class="block mt-1 w-full pl-10 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500" type="email" name="email" :value="old('email')" required autofocus />
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M5.05 4.1C4.6 5.46 4 6.63 4 8c0 4 6 10 6 10s6-6 6-10c0-1.37-.6-2.54-1.05-3.9a8.003 8.003 0 00-9.9 0zM10 7a2 2 0 110-4 2 2 0 010 4z" />
                    </svg>
                </span>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pl-10 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500" type="password" name="password" required />
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a4 4 0 00-4 4v2a2 2 0 01-1 1.732V13a3 3 0 003 3h4a3 3 0 003-3v-2.268A2 2 0 0114 9V7a4 4 0 00-4-4zM8 7a2 2 0 114 0v2H8V7zm2 7a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                </span>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center text-gray-600">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500" name="remember">
                <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
            </label>
            <a class="text-sm text-purple-600 hover:underline" href="{{ route('password.request') }}">
                {{ __('Forgot Password?') }}
            </a>
        </div>

        <!-- Login Button -->
        <div class="mt-6">
            <button type="submit" class="w-full py-2 px-4 bg-gradient-to-r from-purple-500 to-purple-700 text-white font-semibold rounded-lg shadow-md hover:from-purple-600 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                {{ __('LOGIN') }}
            </button>
        </div>
    </form>
</x-guest-layout>
