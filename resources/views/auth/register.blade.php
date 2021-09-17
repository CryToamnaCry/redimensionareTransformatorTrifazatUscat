@extends('layouts.app')
@section('content')
    <div class="flex justify-center">
        <div class="bg-white p-6  rounded-lg w-4/12 shadow sm:shadow-md md:shadow-lg lg:shadow-xl xl:shadow-2xl">
            <p class="text-sm text-gray-600 flex items-center">
                <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
                </svg>
                Daca aveti cont accesati urmatorul l 

                <a href="{{ route('register') }}" class="no-underline hover:underline text-blue-500 ">     ink</a>
                .
              </p>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="name" class="sr-only">Nume si prenume</label>
                    <input type="text" name="name" id="name" placeholder="Nume si prenume" value="{{ old('name') }}" 
                    class="bg-white border-b-2 w-full p-4  border-black
                    @error('name') border-red-500  
                    @enderror">
                    
                    @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="username" class="sr-only">Grupa</label>
                    <select name="username" id="username"  
                    value="{{ old('username') }}" class="bg-white border-b-2 w-full p-4  border-black
                     @error('username') border-red-500  
                     @enderror">
                        @foreach ($grupa as $grupUnit)
                            <option>{{ $grupUnit }}</option>
                        @endforeach
                    </select>


                     
                     @error('username')
                         <div class="text-red-500 mt-2 text-sm">
                             {{ $message }}
                         </div>
                     @enderror
                
                </div>

                <div class="mb-4">
                    <label for="email" class="sr-only">Adresa de e-mail</label>
                    <input type="text" name="email" id="email" placeholder="Adresa de e-mail" value="{{ old('email') }}" 
                    class="bg-white border-b-2 w-full p-4  border-black
                    @error('email') border-red-500  
                    @enderror">
                    
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Parola</label>
                    <input type="password" name="password" id="password" placeholder="Alegeti o parola" 
                    value="" class="bg-white border-b-2 w-full p-4  border-black  @error('password') border-red-500  
                    @enderror">
                    
                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="sr-only">Repetati parola</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repetati parola" value="" 
                    class="bg-white border-b-2 w-full p-4  border-black
                    @error('password_confirmation') 
                    border-red-500  
                    @enderror">
                    
                    @error('password_confirmation')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                        Creati cont
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection