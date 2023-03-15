<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        
    </head>
    <body class="bg-gray-100">
<div>
    <nav>
        <div class="bg-gray-200 flex flex-wrap justify-between p-6 items-center shadow">
        
        <div><a href="{{ url('/') }}"><image img src="{{asset('image/Gerpinglogolol.png')}}"></image></a></div>
        
        
        
        <div>@if (Route::has('login'))        
                                      
                    @auth
                        <a href="{{ url('/dashboard') }}" class="m-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 ml-4">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 ml-4">Register</a>
                        @endif
                    @endauth
                
            @endif</div>
            
        </div>
    </nav>
</div>

<div class="flex justify-center items-center min-h-screen" >

    <div class="bg-slate-100">

    </div>
<div class="bg-white p-6 rounded-lg shadow-md ">
<div class="flex p-6 justify-center items-center font-bold">{{ $answer ?? "yes/no"}}</div>
<div class="flex p-6 justify-center items-center">{{ $word ?? "Wort"}}</div>
<div>

            <form method="post" action="/Gerping/public/practice">
            @csrf
            <input type="submit" name="button" value="der" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"></input>
            <input type="submit" name="button" value="die" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"></input>
            <input type="submit" name="button" value="das" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"></input>
            </form>
        </div>
        
    </div>

</div>


</body>