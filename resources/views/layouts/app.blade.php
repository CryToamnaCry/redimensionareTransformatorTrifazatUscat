<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posty</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-200">
  
    <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
            <li>
                <a href="{{ route('home') }}" class="p-3">Home</a>
            </li>
            @auth
            <li>
                <a href="{{ route('dashboard') }}" class="p-3">Vizualizare
                    
                    @if (auth()->user()->is_admin==0)
                    <br/>
                    &incarcare 
                    @endif
                    proiect
                </a>
            </li>
            <li>
                <a href="{{ route('redimensionare') }}" class="p-3">Estimare</a>
            </li>
            <li>
                <a href="{{ route('posts') }}" class="p-3">Chat zone</a>
            </li>
            @if (auth()->user()->is_admin==1)
            <li>
                <a class="p-3" href="{{ route('admin') }}">
                    Zona profesori
                </a>
            </li>
            @endif
            @endauth
        </ul>

        <ul class="flex items-center">
            @auth
                <li>
                    <a href="" class="p-3">{{auth()->user()->name}}</a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class=" p-3 inline">
                        @csrf
                        <button type="submit" >
                            Logout
                        </button>
                      
                    </form>
                </li>
            @endauth


            @guest
                <li>
                    <a href="{{ route('login') }}" class="p-3">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="p-3">Register</a>
                </li> 
            @endguest
     
        </ul>
    </nav>
    @yield('content')
</body>
</html>