@props(['detalii'=> $detalii])
<x-sideMenu :detalii="$detalii" />

<div class="flex justify-center " >
    
    <div class=" p-10  rounded-lg notepaper">
        <div class=" py-5" >
            <h1 class="text-lg font-medium text-blue-900 block" >
              Proiectarea unui transformator trifazat cu regim uscat:
            </h1>
          </div>
          @foreach ($detalii as $key => $value)
          
          <div class=" p-5 sticker" id='{{ $loop->iteration }}'>
            <p class="text uppercase text-white">
              
              {{$key}}
              
              
            </p>
          </div>
          
          <hr>
          <x-nominale :value="$value" /> 
          @endforeach

  </div>
    </div>