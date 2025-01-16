<x-guest-layout>  
    <div class="flex min-h-screen">  
        <!-- Left Section -->  
        <div class="w-1/2 bg-gradient-to-br from-purple-600 to-blue-700 flex flex-col justify-center items-center text-white p-8">  
            <div class="text-center">  
                <h1 class="text-4xl font-bold">Welcome to GudangEasy</h1>  
                <p class="mt-4 text-lg">Your trusted warehouse management solution</p>  
            </div>  
        </div>  
  
        <!-- Right Section -->  
        <div class="w-1/2 flex flex-col justify-center items-center bg-white p-8">  
            <h2 class="text-3xl font-bold text-purple-800">LOGIN</h2>  
            <p class="mt-2 text-sm text-gray-600">Welcome to GudangEasy, Please Login to Your Account!</p>  
  
            <!-- Alert for errors -->  
            @if ($errors->any())  
                <div class="mb-4 text-red-600">  
                    <ul>  
                        @foreach ($errors->all() as $error)  
                            <li>{{ $error }}</li>  
                        @endforeach  
                    </ul>  
                </div>  
            @endif  
  
            <!-- Login Form -->  
            <form method="POST" action="{{ route('login') }}" class="mt-8 w-3/4">  
                @csrf  
  
                <!-- Email -->  
                <div class="mb-4">  
                    <label for="email" class="block text-sm font-medium text-gray-700">Username</label>  
                    <div class="relative mt-1">  
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus  
                            class="block w-full rounded-full border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm p-4 pl-12 bg-gray-100">  
                        <span class="absolute inset-y-0 left-4 flex items-center">  
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 14l-4-4m0 0l-4 4m4-4v12m8-6H4" />  
                            </svg>  
                        </span>  
                    </div>  
                </div>  
  
                <!-- Password -->  
                <div class="mb-4">  
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>  
                    <div class="relative mt-1">  
                        <input id="password" type="password" name="password" required  
                            class="block w-full rounded-full border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm p-4 pl-12 bg-gray-100">  
                        <span class="absolute inset-y-0 left-4 flex items-center">  
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7v14" />  
                            </svg>  
                        </span>  
                    </div>  
                </div>  
  
                <!-- Submit Button -->  
                <div>  
                    <button type="submit"  
                        class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-3 rounded-full shadow-lg hover:opacity-90 transition duration-300">  
                        LOGIN  
                    </button>  
                </div>  
            </form>  
        </div>  
    </div>  
</x-guest-layout>  
