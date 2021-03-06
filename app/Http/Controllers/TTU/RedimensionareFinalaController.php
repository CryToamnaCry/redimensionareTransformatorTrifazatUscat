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
            'Toleran??ele impuse parametrilor electrici nominali'=>$tolerante,
            'Valoarea folosit?? pentru diamentrul coloanei'=>$coloana,
            'Dimensionarea ??nf????ur??rii de joas?? tensiune'=>$JS,
            'Dimensionarea ??nf????ur??rii de ??nalt?? tensiune'=>$IT,
            'Calculul miezului feromagnetic'=>$miez

        );
        $title = 'Valori principale rezultate in urma estimarii unui transformator trifazat cu regim uscat folosind datele nominale introduse';
     return [$all , $title];

    }
    public function show($id)
    {
        $response = $this->takeFromDb($id);
        $all = $response[0];
        $title = $response[1];
    

        return view('TTU.final',[
            'detalii' => $all,
            'title' => $title
        ]);
    }


}
