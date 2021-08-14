<?php

namespace App\Http\Controllers\TTU;

use App\Models\DateNominale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\view\ViewITController;
use App\Http\Controllers\view\ViewJSController;
use App\Http\Controllers\view\ViewNominaleController;
use App\Http\Controllers\view\ViewMiezFeromgneticController;
use App\Http\Controllers\view\ViewDiametrulColoaneiController;
use App\Http\Controllers\joasaTensiune\DimensionareJTController;
use App\Http\Controllers\STAS\DeterminareMarimiDeFazaController;
use App\Http\Controllers\inaltaTensiune\DimensionareITController;
use App\Http\Controllers\coloana\PredimensionareColoanaController;
use App\Http\Controllers\miezFeromagnetic\MiezFeromagneticController;
use App\Http\Controllers\joasaTensiune\PredimensionareSpiraController;
use App\Http\Controllers\joasaTensiune\PredeterminareSectiuneConductorJTController;



class RedimensionareFinalaController extends Controller
{

    public function store(Request $request)
    {     
        $marimiDeFaza = new DeterminareMarimiDeFazaController;
        $marimiDeFaza->creareMarimiDeFaza($request);

        $predColoana = new PredimensionareColoanaController;
        $predColoana->store($request);

        $predSpiraJT = new PredimensionareSpiraController;
        $predSpiraJT->store($request);
       
        $predSectConductorJT = new PredeterminareSectiuneConductorJTController;
        $predSectConductorJT->store($request);

        $dimensionareJT = new DimensionareJTController;
        $dimensionareJT->store($request);

        $dimensionareIT = new DimensionareITController;
        $dimensionareIT->store($request);

        $miez = new MiezFeromagneticController;
        $miez->store($request);

        return $this->show($request->user()->id);
 
    }
    public function takeFromDb($id)
    {
        $dateNominale = new ViewNominaleController;
        $tolerante = $dateNominale->tolerante($id);
        $dateNominale = $dateNominale->show($id);
        

        $coloana = new ViewDiametrulColoaneiController;
        $coloana = $coloana->show($id);

        $JS = new ViewJSController;
        $JS = $JS->show($id);

        $IT = new ViewITController;
        $IT = $IT->show($id);

        $miez = new ViewMiezFeromgneticController;
        $miez = $miez->show($id);

        $all = array(
            'Valori nominale'=>$dateNominale,
            'Toleranțele impuse parametrilor electrici nominali'=>$tolerante,
            'Valoarea folosită pentru diamentrul coloanei'=>$coloana,
            'Dimensionarea înfășurării de joasă tensiune'=>$JS,
            'Dimensionarea înfășurării de înaltă tensiune'=>$IT,
            'Calculul miezului feromagnetic'=>$miez

        );
     return $all;

    }
    public function show($id)
    {
        $all = $this->takeFromDb($id);
    
        return view('TTU.final',[
            'detalii' => $all
        ]);
    }


}
