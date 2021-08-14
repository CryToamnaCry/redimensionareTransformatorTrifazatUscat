@props(['value'=> $value])

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($value as $val)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">

                        {{$val['denumire']}} 
                       
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 ">
                  <div class="text-sm text-gray-500">
                    <p class="lining-nums">{{$val['valoare']}}</p>
                    
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-500">
                    
                    {{$val['unit']}}      
                  
                    
                    </div>
                </td>
                
              </tr>
  
  
              <!-- More people... -->
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>