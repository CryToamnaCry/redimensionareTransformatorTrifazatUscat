
<div class="notepad">
    <div class="note-holder">
        
        <div class="paper justify-items-center">
            <ul class="lines">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
              </ul>
          <ul class="vertical-lines">
            <li></li>
            <li></li>
          </ul>
    <form action="{{route('dashboard')}}" method="post" enctype="multipart/form-data">
      <h3 class="">Upload File in Laravel</h3>
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

        <div class="custom-file">
            <input type="file" name="file" class="custom-file-input" id="chooseFile">
            <label class="custom-file-label" for="chooseFile">Select file</label>
        </div>

        <button type="submit" name="submit" class="ring-4  uppercase ring-green-500 ring-opacity-50">
            Upload Files
        </button>
    </form>
</div>
</div>
</div>
</div>