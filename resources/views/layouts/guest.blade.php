<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @php  
        $isProduction = app()->environment('production');  
        $manifestPath = $isProduction ? '../public_html/build/manifest.json' : public_path('build/manifest.json');  
    @endphp  
      
    @if ($isProduction && file_exists($manifestPath))  
        @php  
            $manifest = json_decode(file_get_contents($manifestPath), true);  
        @endphp  
        <link rel="stylesheet" href="{{ config('app.url') }}/build/{{ $manifest['resources/css/app.css']['file'] }}">  
        <script type="module" src="{{ config('app.url') }}/build/{{ $manifest['resources/js/app.js']['file'] }}"></script>  
    @else  
        @viteReactRefresh  
        @vite(['resources/js/app.js', 'resources/css/app.css'])  
    @endif      </head>
    <body class="font-sans text-gray-900 antialiased">
        {{ $slot }}

    </body>
</html>
