
<div class="notepad">
    <div class="note-holder">
        
        <div class="paper justify-items-center  pt-5 pl-2">
           

    <form action="{{route('dashboard')}}" method="post" enctype="multipart/form-data">
      <h3 class="">Incarcare proiect</h3>
        @csrf
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <strong>{{ $message }}</strong>
        </div>
      @endif

      @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

        <div class="custom-file py-5">
            <input type="file" name="file" class="custom-file-input" id="chooseFile">
        </div>

        <button type="submit" name="submit" class="ring-4 rounded uppercase ring-green-300 bg-green-300 ">
          salveaza
        </button>
    </form>
   
    <br/>
     <a class=" link rounded  text-red-500 hover:underline" href="{{ route('books.download', auth()->user()->id) }}">Descarcare fisier incarcat</a> 
                        
</div>
</div>
</div>
</div>