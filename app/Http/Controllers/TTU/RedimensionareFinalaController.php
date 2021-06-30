<?php

namespace App\Http\Controllers\TTU;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TTU\RedimensionareFinalaController;



class RedimensionareFinalaController extends Controller
{
    public function __construct(Request $request){
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {

        
        return view('TTU.final');
    }
}
