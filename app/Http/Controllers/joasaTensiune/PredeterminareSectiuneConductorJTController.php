<?php

namespace App\Http\Controllers\joasaTensiune;

use App\Models\DateNominale;
use App\Models\MarimiDeFaza;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PredimensionareColoana;
use App\Models\PredimensionareSpiraJT;
use App\Http\Controllers\math\ExtraController;
use Cartalyst\Converter\Laravel\Facades\Converter;
use App\Http\Controllers\TTU\DistanteDeIzolatieController;
use App\Http\Controllers\joasaTensiune\PredimensionareSpiraController;

class PredeterminareSectiuneConductorJTController extends Controller
{
    public function create(Request $request)
    {
        $dateNominale = DateNominale::latest()->where('user_id',$request->user()->id)->first();
        $f = $dateNominale->f_Hz;
        $id = $dateNominale->id;
        $u2f = $dateNominale->u2n_V;
        $pscn_W = $dateNominale->pscn_W;

        $faza = MarimiDeFaza::latest()->where('nominale_id',$id)->first();
        $I2f = $faza->i2f;

        $coloana = PredimensionareColoana::latest()->where('nominales_id',$id)->first();
        $sum_ajai_cm = $coloana->sum_ajai_cm;
        $D_m = $coloana->D_m;

        $spira = PredimensionareSpiraJT::latest()->where('nominale_id',$id)->first();
        $wj = $spira->wj_spire;

        $uIncerc = DistanteDeIzolatieController::transformatorUscatUIncercare($u2f);
        $distanteDeIzolatie = DistanteDeIzolatieController::transformatorUscatJT($uIncerc);
        $aoj = $distanteDeIzolatie['aoj'];

        $pCu = ExtraController:: pCu(); //ohm*mm^2 / m

        // PjT - Pierderile Joule JT
        $PjT = (5/11)*$pscn_W;//W
        
        //RjT - rezistenta infasurarii
        $RjT = $PjT/(3*pow($I2f,2));//ohm
        //aoj - distanta dintre coloana si JT
        //aj = grosimea infasurarii JT
        $aj = $sum_ajai_cm/2;//cm
        $D_mm = Converter::from('length.m')->to('length.mm')->convert($D_m)->getValue();
        $aj_mm = Converter::from('length.cm')->to('length.mm')->convert($aj)->getValue();
        $aoj_mm = Converter::from('length.m')->to('length.mm')->convert($aoj)->getValue();
        //Dmj - diametrul mediu JT
        $Dmj_mm = $D_mm+2*$aoj_mm+$aj_mm;

        // Lmed - lungimea medie a unei spire jT
        $Lmed_mm = pi()*$Dmj_mm;
        $Lmed_m = Converter::from('length.mm')->to('length.m')->convert($Lmed_mm)->getValue();

        //Se estimeaza 
        //  scond - Sectiunea conductorului
        $scond_mm2 = ($pCu*$Lmed_m*$wj)/$RjT;
        //dc - diametru conductor estimat
        $dc_mm = sqrt((4*$scond_mm2)/pi());

        
        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        //dc din STAS(care STAS)????
        ////////////////////////////////
        $dc_mm_rot = round($dc_mm);
        //////////////////////////////////
        dd($dc_mm_rot,$dc_mm);

        $sectiuneConduct= array( 
            'PjT_W'=>$PjT,
            'RjT_ohm'=>$RjT,
            'Dmj'=>$Dmj_mm,
            'Lmed'=>$Lmed_mm,
            'scond'=> $scond_mm2,
            'dc' => $dc_mm
        );
        

    }
}
