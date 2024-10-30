@props(['disabled' => false])

<input 
    @disabled($disabled) 
    {{ $attributes->merge(['class' => 'bg-white text-gray-800 border-gray-300 rounded-lg shadow-sm focus:border-purple-500 focus:ring-purple-500']) }} 
    type="email" 
    id="email" 
    name="email" 
    value="{{ old('email') }}" 
    required 
    autofocus 
/>
