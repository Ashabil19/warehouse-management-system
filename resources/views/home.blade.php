@extends('layouts.sidebar')  
  
@section('title', 'Home')  
  
@section('content')  
    @if (Auth::guest())  
        <div class="flex flex-col items-center justify-center h-screen text-center">  
            <h1 class="text-3xl font-semibold mb-4">Home Page</h1>  
            <p class="text-lg text-gray-700 mb-6">Welcome to the Home page!</p>  
              
            <img src="https://via.placeholder.com/800x400" alt="Placeholder Image" class="rounded-lg shadow-lg mb-6">  
  
          
        </div>  
    @else  
        <div class="flex flex-col items-center justify-center h-screen text-center">  
            <h1 class="text-3xl font-semibold mb-4">Welcome Back!</h1>  
            <p class="text-lg text-gray-700 mb-6">You are already logged in.</p>  
        </div>  
    @endif  
@endsection  
