<?php

namespace App\Http\Controllers;

use App\Models\upload\File;
use Illuminate\Http\Request;
use App\Http\Controllers\TTU\RedimensionareFinalaController;

class DashboardController extends Controller
{
    public function __construct(Request $request){
        $this->middleware(['auth']);
    }
    
    public function index(Request $request)
    {
        
        $final = new RedimensionareFinalaController;
        $all = $final->takeFromDb($request->user()->id);

        return view('dashboard',[
            'detalii' => $all
        ]);
    }

    public function fileUpload(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
            ]);
    
            $fileModel = new File;
    
            if($req->file()) {
                $fileName = time().'_'.$req->file->getClientOriginalName();
                $fileModel->user_id = $req->user()->id;
                $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
    
                $fileModel->name = time().'_'.$req->file->getClientOriginalName();
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->save();
    
                return back()
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);
            }
    }
}
