<?php

namespace App\Http\Controllers;

use App\Models\DateNominale;
use App\Models\MarimiDeFaza;
use Illuminate\Http\Request;
use Cartalyst\Converter\Converter;
use Illuminate\Routing\Controller;
use App\Models\PredimensionareColoana;
use App\Models\PredimensionareSpiraJT;
use App\Http\Controllers\math\ExtraController;
use App\Http\Controllers\math\MathStuffController;
use App\Http\Controllers\STAS\DiametruConductorController;
use App\Http\Controllers\STAS\DistanteDeIzolatieController;
use App\Models\joasaTensiune\PredeterminareSectiuneConductorJT;
use App\Http\Controllers\STAS\GrosimeaIzolatieiConductoruluiController;

class DimensionareInfasurareJTController extends Controller
{
    public function create(Request $request)
    {
    $dateNominale = DateNominale::latest()->where('user_id',$request->user()->id)->first();
        $f = $dateNominale->f_Hz;
        $id = $dateNominale->id;
        $u2f = $dateNominale->u2n_V;
        $pscn_W = $dateNominale->pscn_W;
        $factorForma = $dateNominale->factorForma;

    $faza = MarimiDeFaza::latest()->where('nominale_id',$id)->first();
    $I2f = $faza->i2f;

    $uIncerc = DistanteDeIzolatieController::transformatorUscatUIncercare($u2f);
        $distanteDeIzolatie = DistanteDeIzolatieController::transformatorUscatJT($uIncerc);
        $aoj = $distanteDeIzolatie['aoj'];

    $coloana = PredimensionareColoana::latest()->where('nominales_id',$id)->first();
        $sum_ajai_cm = $coloana->sum_ajai_cm;
        $D_mm = Converter::from('length.m')->to('length.mm')->convert($coloana->D_m)->getValue();

    $spira = PredimensionareSpiraJT::latest()->where('nominale_id',$id)->first();
        $wj = $spira->wj_spire;

   $STAS_dc_mm = GrosimeaIzolatieiConductoruluiController::giz_mm();
   $STAS_giz_mm = DiametruConductorController::giz_mm(); 

   $predimensionareJT = PredeterminareSectiuneConductorJT::latest()->where('nominales_id',$id)->first();
   $PjT = $predimensionareJT->PjT_W;
   $Lmed_mm = $predimensionareJT->Lmed_mm;
   $s_cond_mm2 = $predimensionareJT->scond_mm2;

    ///////////////////////////////////////////
    /////dc,giz -din STAS???
    ///////////////////////////////////////////
        

    $diz = $STAS_dc_mm + $STAS_giz_mm;
    
    
    $aj_mm = Converter::from('length.cm')->to('length.mm')->convert($aj)->getValue();
    $aoj_mm = Converter::from('length.m')->to('length.mm')->convert($aoj)->getValue();
    $Dmj_mm = $D+2*$aoj+2*$aj+$aji;

    $HB_mm = (pi()*$Dmj_mm)/$factorForma;
    $spireStrat =MathStuffController::round_5(($HB_mm/$diz)-1);
    $nrStraturi = round($wj/$spireStrat);
    $HB_m = Converter::from('length.mm')->to('length.m')->convert($HB_mm)->getValue();
    $Lmed_m = Converter::from('length.mm')->to('length.m')->convert($Lmed_mm)->getValue();
    $qjT_Wperm2 = $PjT/(3*2*$HB_m*$Lmed_m);

    //se RECALCULEAZA
    $aj_mm = $diz*$nrStraturi;

    //HBj - Inaltimea bobinajului jT
    $HBj_m = ( $spireStrat/$nrStraturi+1)*$diz;
 
        //verificam daca e nevoie sau nu sa adaugam canal de racire 
        $redimensionare = ExtraController::canalDeRacire($nrStraturi,$diz,$D_mm,$aoj_mm,$wj,$s_cond_mm2,$I2f,$HBj_m);
    

    $dimensionareInfasJT = array( 
        'dateNominales_id'=>$id,
        'Dmj_mm'=>$redimensionare['Dmj_mm'],
        'Lmed_m'=>$redimensionare['LMed_m'],
        'Rjt_ohm'=>$redimensionare['Rjt_ohm'],
        'PjT_W'=>$redimensionare['PjT_W'],
        'qjT_Wperm2'=>$redimensionare['qjT_Wperm2'],
        'spireStrat' =>$spireStrat,
        'nrStraturi' =>$nrStraturi,
        'aj_mm' =>$redimensionare['aj_mm'],
        'HBj_m'=>$redimensionare['HBj_m'] 
        
    );

    }

    public function store(Request $request)
    {

        $coloana = $this->create($request);
     

        DimensionareInfasurareJT::create([
            'nominales_id'=>$coloana['dateNominales_id'],
            'Dmj_mm' => $coloana['Dmj_mm'],
            'Lmed_m'=>$coloana['Lmed_m'],
            'Rjt_ohm'=>$coloana['Rjt_ohm'],
            'PjT_W'=>$coloana['PjT_W'],
            'aj_mm'=>$coloana['aj_mm'],
            'qjT_Wperm2'=>$coloana['qjT_Wperm2'],
            'spireStrat' =>$coloana['spireStrat'],
            'nrStraturi' =>$coloana['nrStraturi'],
            'HBj_m'=>$coloana['HBj_m']

         
        ]);
   
      
 
    }
   
}
