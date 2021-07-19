<?php

namespace App\Http\Controllers\TTU;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TTU\RedimensionareFinalaController;
use App\Http\Controllers\STAS\DeterminareMarimiDeFazaController;
use App\Http\Controllers\coloana\PredimensionareColoanaController;
use App\Http\Controllers\joasaTensiune\PredimensionareSpiraController;
use App\Http\Controllers\joasaTensiune\PredeterminareSectiuneConductorJTController;



class RedimensionareFinalaController extends Controller
{
    public function __construct(Request $request){
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {     
        $marimiDeFaza = new DeterminareMarimiDeFazaController;
        $marimiDeFaza->creareMarimiDeFaza($request);

        $predColoana = new PredimensionareColoanaController;
        $predColoana->store($request);

        $predSpiraJT = new PredimensionareSpiraController;
        $predSpiraJT->store($request);
       
        $predSectConductorJT = new PredeterminareSectiuneConductorJTController;
        $predSectConductorJT->store($request);

        return view('TTU.final');
    }
}
