@extends('layouts.app')
@section('content')
    <div class="flex justify-center ">
        <div class="bg-white p-6  rounded-lg w-4/12 shadow sm:shadow-md md:shadow-lg lg:shadow-xl xl:shadow-2xl">
            <p class="text-sm text-gray-600 flex items-center">
                <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
                </svg>
                Daca nu aveti cont accesati urmatorul 

                <a href="{{ route('register') }}" class="no-underline hover:underline text-blue-500 ">     link</a>
                .
              </p>
            @if (session()->has('status'))
            <div class="text-red-500 mt-2 text-sm">

                {{session('status')}}

            </div>

            @endif
            <form action="{{ route('login') }}" method="post" >
                @csrf

                <div class="mb-4">
                    <label for="email" class="sr-only">Adresa de email</label>
                    <input type="text" name="email" id="email" placeholder="Your email" value="{{ old('email') }}" 
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
                    <input type="password" name="password" id="password" placeholder="Choose a password" 
                    value="" class="bg-white border-b-2 w-full p-4  border-black  
                    @error('password') border-red-500  
                    @enderror">
                    
                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <div class="felx items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        <label for="remember">Tineti-ma minte</label>
                    </div>
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                        Inregistrare
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection