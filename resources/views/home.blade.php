@extends('layouts.sidebar')  
  
@section('title', 'Home - GudangEasy')  
  
@section('content')  
    @if (Auth::guest())  
        <div class="flex flex-col items-center justify-center h-screen text-center">  
            <h1 class="text-3xl font-semibold mb-4">Home Page</h1>  
            <p class="text-lg text-gray-700 mb-6">Welcome to the Home page!</p>  
            <img src="{{ asset('images/testindo-logo.jpg') }}" alt="Testindo Logo" class="rounded-lg shadow-lg mb-6">  
        </div>  
    @else  
        <div class="flex flex-col items-center justify-center h-screen text-center">  
            <h1 class="text-3xl font-semibold mb-4">Welcome Back!</h1>  
            <p class="text-lg text-gray-700 mb-6">You are already logged in.</p>  
            <img src="{{ asset('images/testindo-logo.jpg') }}" alt="Testindo Logo" class="rounded-lg shadow-lg mb-6">  

        </div>  
    @endif  
@endsection  
