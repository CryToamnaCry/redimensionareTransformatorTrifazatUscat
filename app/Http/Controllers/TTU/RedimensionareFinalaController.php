<?php

namespace App\Http\Controllers\TTU;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TTU\RedimensionareFinalaController;
use App\Http\Controllers\TTU\S1CalcululMarimilorDeFazaController;
use App\Http\Controllers\coloana\PredimensionareColoanaController;



class RedimensionareFinalaController extends Controller
{
    public function __construct(Request $request){
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {     
        $marimiDeFaza = new S1CalcululMarimilorDeFazaController;
        $marimiDeFaza->creareMarimiDeFaza($request);

        $predimensionareColoana = new PredimensionareColoanaController;
        $predimensionareColoana->store($request);

        

        return view('TTU.final');
    }
}
