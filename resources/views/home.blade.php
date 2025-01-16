@extends('layouts.sidebar')  
  
@section('title', 'Home')  
  
@section('content')  
    @if (Auth::guest())  
        <div class="flex flex-col items-center justify-center h-screen text-center">  
            <h1 class="text-3xl font-semibold mb-4">Home Page</h1>  
            <p class="text-lg text-gray-700 mb-6">Welcome to the Home page!</p>  
              
            <img src="https://via.placeholder.com/800x400" alt="Placeholder Image" class="rounded-lg shadow-lg mb-6">  
  
            <a href="{{ route('login') }}"   
               class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition duration-200">  
                Login  
            </a>  
        </div>  
    @else  
        <div class="flex flex-col items-center justify-center h-screen text-center">  
            <h1 class="text-3xl font-semibold mb-4">Welcome Back!</h1>  
            <p class="text-lg text-gray-700 mb-6">You are already logged in.</p>  
        </div>  
    @endif  
@endsection  
