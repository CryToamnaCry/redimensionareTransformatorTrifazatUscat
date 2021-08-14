@props(['detalii'=> $detalii])

<nav class="side-menu">
    <ul>
        @foreach ($detalii as $key => $value)
      <li class='rounded-r-md'><a href="#{{ $loop->iteration }}">{{$key}}<span>{{ $loop->iteration }}</span></a></li>
        @endforeach
      
    </ul>
  </nav>

  