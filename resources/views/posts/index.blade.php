<!DOCTYPE html>
<html>
<head>
    @vite('resources/css/app.css')

    <title>Posts</title>
</head>
<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{-- {{ __('Dashboard') }} --}}
                Purchasing!
               
            </h2>
        </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <a href="{{ route('posts.create') }}" class=" bg-red-500 rounded-lg p-4 shadow-md text-white">Create Post</a>



                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase mb-10 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Product name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Vendor
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Category
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Jumlah
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                            @foreach($posts as $post)
                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <a href="{{ route('posts.edit', $post->id) }}">{{ $post->title }}</a>
                                                    </td>
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <p>{{ $post->content }}</p>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                 
                                    
                                </tbody>
                            </table>
                        </div>

                        {{-- {{ __("You're logged in!") }} --}}
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>



    
    {{-- <h1>Posts</h1> --}}
    {{-- <a href="{{ route('posts.create') }}">Create Post</a>


    <ul>
        @foreach($posts as $post)
            <li>
                <a href="{{ route('posts.edit', $post->id) }}">{{ $post->title }}</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul> --}}
</body>
</html>
