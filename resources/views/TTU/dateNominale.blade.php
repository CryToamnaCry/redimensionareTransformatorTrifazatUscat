@extends('layouts.app')
@section('content')

<div class="flex justify-center ">
    
    <div class="bg-white p-12 rounded-lg w-8/12 ">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
              Applicant Information
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
              Personal details and application.
            </p>
          </div>
          <hr>

        <form action="{{route('redimensionare')}}" method="post" class="mb-4 border-t">
            @csrf
            {{-- 
                
                Pn 
                
                --}}
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-2/6 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-900 text-s font-bold mb-2" for="sn">
                        Putere nominala
                    </label>
                    <input class="appearance-none block  bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:sm-white focus:border-gray-500
                    @error('sn') border-red-500  
                    @enderror"
                     name="sn" id="sn" type="text" placeholder="Sn = 12,5" value="{{ old('sn') }}">

                     @error('sn')
                     <div class="text-red-500 mt-2 text-sm">
                         {{ $message }}
                     </div>
                    @enderror

                </div>
                <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0 mt-2">
                    <label class="block  tracking-wide text-gray-700 text-xs font-bold mb-2" for="snUnit">
                    Unit
                    </label>
                    <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="snUnit" name="snUnit">
                            @foreach ($putereAparentaUnits as $putereAparentaUnit)
                                <option>{{ $putereAparentaUnit }}</option>
                            @endforeach
                         </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
             {{-- 
                
                f
                
                --}}
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-2/6 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-900 text-s font-bold mb-2" for="f">
                            Frecventa
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500
                        @error('f') border-red-500  
                        @enderror"
                         id="f" name=f type="number" placeholder="f" value="{{ old('f') }}">

                         @error('f')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0 mt-2">
                        <label class="block  tracking-wide text-gray-700 text-xs font-bold mb-2" for="fUnit">
                        Unit
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="fUnit" name='fUnit'>
                                @foreach ($frequencyUnits as $frequencyUnit)
                                    <option>{{ $frequencyUnit }}</option>
                                @endforeach
                             </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            {{-- 
                
                Un
                
                --}}
            <div class="flex flex-wrap -mx-3 ">
                <div class="w-full  px-3  md:mb-0">
                <h1 class='block uppercase tracking-wide text-gray-900 text-m font-bold mb-2'>Tensiuni nominale</h1>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-2">
               
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="u1n">
                        U1n
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500
                    @error('u1n') border-red-500  
                    @enderror"
                     id="u1n" name="u1n" type="number" placeholder="Ex.12.5" value="{{ old('u1n') }}">

                     @error('u1n')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
                <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                    <label class="block u tracking-wide text-gray-500 text-xs font-bold mb-2" for="u1nUnit">
                    Unit
                    </label>
                    <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="u1nUnit" name="u1nUnit">
                            @foreach ($voltageUnits as $voltageUnit)
                                <option>{{ $voltageUnit }}</option>
                            @endforeach
                         </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="u2n">
                        U2n
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500
                    @error('u2n') border-red-500  
                    @enderror"
                     id="u2n" name="u2n"  type="number" name="" placeholder="Ex.12.5" value="{{ old('u2n') }}">


                     @error('u2n')
                     <div class="text-red-500 mt-2 text-sm">
                         {{ $message }}
                     </div>
                    @enderror

                </div>
                <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                    <label class="block  tracking-wide text-gray-500 text-xs font-bold mb-2" for="u2nUnit">
                    Unit
                    </label>
                    <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name ="u2nUnit" id="u2nUnit">
                            @foreach ($voltageUnits as $voltageUnit)
                                <option>{{ $voltageUnit }}</option>
                            @endforeach
                         </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            {{-- 

                Schema și grupa de conexiuni
            
            --}}
            <div class="flex flex-wrap -mx-3 ">
                <div class="w-full  px-3  md:mb-0">
                <h1 class='block uppercase tracking-wide text-gray-900 text-m font-bold mb-2'>Schema și grupa de conexiuni</h1>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-2">
               
                <div class="w-full  px-3 md:w-1/3  md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="sc1conex">
                        primara
                    </label>
                    <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="sc1conex" name="sc1conex">
                               
                            <option>Y</option>
                            <option>D</option>
                                
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="w-full  px-3 md:w-1/3  md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="sc2conex">
                        secundara
                    </label>
                    <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="sc2conex" name="sc2conex">
                               
                            <option>y</option>
                            <option>d</option>
                                
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="w-full  px-3 md:w-1/6  md:mb-0 tracking-wide">
                    <label class="block  tracking-wide text-white text-xs font-bold mb-2" for="grConex">
                        Unit
                        </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500
                    @error('grConex') border-red-500  
                    @enderror"
                     id="grConex" name="grConex" type="number" min="1" max="12" value="{{ old('grConex') }}">

                     @error('grConex')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <hr>
            {{-- 

                Tensiunea de scurtcircuit [%]

             --}}
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-900 text-m font-bold mb-2" for="uscn">
                        Tensiunea de scurtcircuit [%]
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500
                    @error('uscn') border-red-500  
                    @enderror"
                    id="uscn" name="uscn" type="number" placeholder="Uscn %" value="{{ old('uscn') }}">

                    @error('uscn')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>
            <hr>
            {{-- 
                
                Puterea la scurtcircuit nominal
                
            --}}
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-900 text-m font-bold mb-2" for="pscn">
                        Puterea la scurtcircuit nominal
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500
                    @error('pscn') border-red-500  
                    @enderror"
                     id="pscn" name="pscn" type="number" placeholder="Pscn" value="{{ old('pscn') }}">

                     @error('pscn')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
                <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0 mt-2">
                    <label class="block  tracking-wide text-gray-700 text-xs font-bold mb-2" for="uscnUnit">
                    Unit
                    </label>
                    <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="pscnUnit" id="pscnUnit">
                            @foreach ($putereRealaUnits as $putereRealaUnit)
                                <option>{{ $putereRealaUnit }}</option>
                            @endforeach
                         </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                    Calculeaza
                </button>
            </div>
        </form>
        
    </div>
</div>
@endsection