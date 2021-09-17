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

    <nav class="bg-white flex items-center justify-between flex-wrap  p-6 mb-4">
        <div class="flex items-center flex-shrink-0 text-blue mr-6">
          <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/></svg>
          <span class="font-semibold text-xl tracking-tight">TransfoWEB</span>
        </div>
        <div class="block lg:hidden">
          <button class="flex items-center px-3 py-2 border rounded text-black-200 border-teal-400 hover:text-white hover:border-yellow">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
          </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
          <div class="text-sm lg:flex-grow">
            
                @guest
               
                    <a href="{{ route('home') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-yellow-600 
                    border-solid
                    border-b-2
                    border-white
                    hover:border-yellow-600
                    mr-4">Home</a>
                
                @endguest
                @auth
                
                    <a href="{{ route('dashboard') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-yellow-600 
                    border-solid
                    border-b-2
                    border-white
                    hover:border-yellow-600
                    mr-4">Vizualizare
                        
                        @if (auth()->user()->is_admin==0)
                        <br/>
                        &incarcare 
                        @endif
                        proiect
                    </a>
                
                    <a href="{{ route('redimensionare') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-yellow-600 
                    border-solid
                    border-b-2
                    border-white
                    hover:border-yellow-600
                    mr-4">Estimare</a>
               
                    <a href="{{ route('posts') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-yellow-600 
                    border-solid
                    border-b-2
                    border-white
                    hover:border-yellow-600
                    mr-4">Chat zone</a>
                
                @if (auth()->user()->is_admin==1)
               
                    <a class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-yellow-600 
                    border-solid
                    border-b-2
                    border-white
                    hover:border-yellow-600
                    mr-4" href="{{ route('admin') }}">
                        Zona profesori
                    </a>
               
                @endif
                @endauth
            
    
          </div>
          <div>
          
                @auth
                    
                    
                            <span class="block mt-4 lg:inline-block lg:mt-0 text-teal-200">
                                {{auth()->user()->name}}
                            </span>
                            
                        
                        <form action="{{ route('logout') }}" method="POST" class=" p-3 inline">
                            @csrf
                            <button type="submit" class="inline-block text-sm px-4 py-2 leading-none rounded text-red hover:border-transparent hover:text-red-500  
                            border-solid
                            border-2
                            border-red-500
                            hover:border-yellow-600 mt-4 lg:mt-0
                            ">
                                Delogare
                            </button>
                          
                        </form>
                    
                @endauth
    
    
                @guest
                 
                        <a href="{{ route('login') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-yellow-600 
                        border-solid
                        border-b-2
                        border-white
                        hover:border-yellow-600
                        mr-4">Autentificare</a>
                    
                        <a href="{{ route('register') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-yellow-600 
                        border-solid
                        border-b-2
                        border-white
                        hover:border-yellow-600
                        mr-4">Creare cont</a>
                  
                @endguest
         
            
          </div>
        </div>
      </nav>
      
   
    @yield('content')
</body>
</html>