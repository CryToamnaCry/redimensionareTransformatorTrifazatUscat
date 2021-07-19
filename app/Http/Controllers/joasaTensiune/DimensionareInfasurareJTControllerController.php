<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DimensionareInfasurareJTController extends Controller
{
    public function create(Request $request)
    {
    $dateNominale = DateNominale::latest()->where('user_id',$request->user()->id)->first();
        $f = $dateNominale->f_Hz;
        $id = $dateNominale->id;
        $u2f = $dateNominale->u2n_V;
        $pscn_W = $dateNominale->pscn_W;

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

    ///////////////////////////////////////////
    /////dc,giz -din STAS???
    ///////////////////////////////////////////
        

    $diz = $STAS_dc_mm + $STAS_giz_mm;
    
    
    $aj_mm = Converter::from('length.cm')->to('length.mm')->convert($aj)->getValue();
    $aoj_mm = Converter::from('length.m')->to('length.mm')->convert($aoj)->getValue();
    $Dmj = $D+2*$aoj+2*$aj+$aji;
    }


   
}
