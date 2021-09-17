<?php

namespace App\Http\Controllers;

use App\Models\upload\File;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\TTU\RedimensionareFinalaController;

class DashboardController extends Controller
{
    public function __construct(Request $request){
        $this->middleware(['auth']);
    }
    
    public function index(Request $request)
    {
        
        $final = new RedimensionareFinalaController;

        $response = $final->takeFromDb($request->user()->id);
        

        $all = $response[0];

        if($all["Valori nominale"]=="nu"){
             return redirect()->route('redimensionare');
        }else{
            $title = $response[1];

        
            return view('dashboard',[
                'detalii' => $all,
                'title' => $title
            ]);
        }
        
    }
    public function download($user_id)
    {
        $file = File::where('user_id', $user_id)->firstOrFail();
        $pathToFile = storage_path('app/public/' .$file->file_path);
        return response()->download($pathToFile);
    }

    public function fileUpload(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
            ]);
    
            if($req->file()) {
                $fileName = time().'_'.$req->file->getClientOriginalName();
                $user_id = $req->user()->id;
                $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');

                File::updateOrCreate([
                    'user_id' => $user_id 
                ],[
                    'user_id' => $user_id,
                    'name' => $fileName,
                    'file_path' => $filePath
                ]);
                
                return back()
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);
            }
    }
}
