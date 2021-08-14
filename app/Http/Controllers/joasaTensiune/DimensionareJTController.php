<?php

namespace App\Http\Controllers\joasaTensiune;

use App\Models\DateNominale;
use App\Models\MarimiDeFaza;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PredimensionareColoana;
use App\Models\PredimensionareSpiraJT;
use App\Models\joasaTensiune\DimensionareJT;
use App\Http\Controllers\math\ExtraController;
use App\Http\Controllers\math\MathStuffController;
use Cartalyst\Converter\Laravel\Facades\Converter;
use App\Http\Controllers\STAS\DiametruConductorController;
use App\Http\Controllers\STAS\DistanteDeIzolatieController;
use App\Models\joasaTensiune\PredeterminareSectiuneConductorJT;
use App\Http\Controllers\STAS\GrosimeaIzolatieiConductoruluiController;

class DimensionareJTController extends Controller
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
    
    $distanteDeIzolatie = DistanteDeIzolatieController::transformatorUscatIT($uIncerc);
        $aji = $distanteDeIzolatie['aji'];
        

    $coloana = PredimensionareColoana::latest()->where('nominale_id',$id)->first();
        $sum_ajai_cm = $coloana->sum_ajai_cm;
        $D_mm = Converter::from('length.m')->to('length.mm')->convert($coloana->D_m)->getValue();

    $spira = PredimensionareSpiraJT::latest()->where('nominale_id',$id)->first();
        $wj = $spira->wj_spire;

    $predimensionareJT = PredeterminareSectiuneConductorJT::latest()->where('nominale_id',$id)->first();
        $PjT = $predimensionareJT->PjT_W;
        $Lmed_mm = $predimensionareJT->Lmed_mm;
        $s_cond_mm2 = $predimensionareJT->scond_mm2;
        $aj_mm = $predimensionareJT->aj_mm;

    ///////////////////////////////////////////
    $STAS_giz_mm = GrosimeaIzolatieiConductoruluiController::giz_mm();
    $STAS_dc_mm = DiametruConductorController::dc_stas_mm();      
    //////////////////////////////////////////
    $diz = $STAS_dc_mm + $STAS_giz_mm;
 
    
    $aoj_mm = Converter::from('length.m')->to('length.mm')->convert($aoj)->getValue();
    $aji_mm = Converter::from('length.m')->to('length.mm')->convert($aji)->getValue();
    

    $Dm_mm = $D_mm+2*$aoj_mm+2*$aj_mm+$aji_mm;
    $HB_mm = (pi()*$Dm_mm)/$factorForma;


    $spireStrat =MathStuffController::round_5(($HB_mm/$diz)-1);
    $nrStraturi = MathStuffController::round_5(($wj/$spireStrat)+1);

    //se RECALCULEAZA
    $aj_mm = $diz*$nrStraturi;

        //verificam daca e nevoie sau nu sa adaugam canal de racire 
        $redimensionare = ExtraController::canalDeRacire($aoj_mm,$aj_mm,$spireStrat,$diz,$D_mm,$wj,$s_cond_mm2,$I2f);  


    $redimensionare+=[
    'nominale_id'=>$dateNominale->id,
    'wj' => $wj,
    'spireStrat' =>$spireStrat,
    'nrStraturi' =>$nrStraturi
         
    ];
    return $redimensionare;

    }

    public function store(Request $request)
    {

        $coloana = $this->create($request);
     
        DimensionareJT::updateOrCreate([
            'nominale_id' =>$coloana['nominale_id'] 
        ],[
            'nominale_id' =>$coloana['nominale_id'],
            'wj' => $coloana['wj'],
            'Dmj_mm' => $coloana['Dmj_mm'],
            'Lmed_m'=>$coloana['LMed_m'],
            'Rjt_ohm'=>$coloana['Rjt_ohm'],
            'PjT_W'=>$coloana['PjT_W'],
            'aj_mm'=>$coloana['aj_mm'],
            'qjT_Wperm2'=>$coloana['qjT_Wperm2'],
            'spireStrat' =>$coloana['spireStrat'],
            'nrStraturi' =>$coloana['nrStraturi'],
            'HBj_m'=>$coloana['HBj_m'],
            'msg'=>$coloana['msg']
        ]);
   
      
 
    }
}
