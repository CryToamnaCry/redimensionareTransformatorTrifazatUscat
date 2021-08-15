@props(['value'=> $value])

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($value as $val)
              <tr>
                @foreach ($val as $key=>$valo)
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900 ">
                        
                        @if ($key=='created_at')
                       
                        <a class="" href="{{ route('books.download', $val['id']) }}">Descarcare</a> 
                        <br/>
                        @endif
                        {{$val[$key]}}
 
                      </div>
                    </div>
                  </div>
                </td>
                @endforeach              
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>