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
use App\Http\Controllers\STAS\DistanteDeIzolatieController;
use App\Models\joasaTensiune\PredeterminareSectiuneConductorJT;


class PredeterminareSectiuneConductorJTController extends Controller
{
    public function create(Request $request)
    {
        $dateNominale = DateNominale::latest()->where('user_id',$request->user()->id)->first();
        $f = $dateNominale->f_Hz;
        $id = $dateNominale->id;
        $u2f = $dateNominale->u2n_V;
        $pscn_W = $dateNominale->pscn_W;
        $nominale_id = $dateNominale->id;

        $faza = MarimiDeFaza::latest()->where('nominale_id',$id)->first();
        $I2f = $faza->i2f;

        $coloana = PredimensionareColoana::latest()->where('nominale_id',$id)->first();
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
        //  scond - Sectiunea conductorului JT
        $scond_mm2 = ($pCu*$Lmed_m*$wj)/$RjT;
        //dc - diametru conductor estimat
        $dc_mm = sqrt((4*$scond_mm2)/pi());

        $dc_ales_mm = 2.3;

        
        //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        //dc din STAS(care STAS)????
        ////////////////////////////////
        //////////////////////////////////
       
        return  $sectiuneConduct= array( 
            'nominale_id' => $nominale_id,
            'PjT_W'=>$PjT,
            'RjT_ohm'=>$RjT,
            'Dmj_mm'=>$Dmj_mm,
            'Lmed_mm'=>$Lmed_mm,
            'scond_mm2'=> $scond_mm2,
            'dc_calc_mm' => $dc_mm,
            'aj_mm' => $aj_mm,
            'dc_ales_mm'=>$dc_ales_mm
        );
        
        
    }

    public function store(Request $request)
    {

        $coloana = $this->create($request);
     
        PredeterminareSectiuneConductorJT::updateOrCreate([
            'nominale_id' =>$coloana['nominale_id'] 
        ],[
            'nominale_id' => $coloana['nominale_id'],
            'PjT_W'=> $coloana['PjT_W'],
            'RjT_ohm'=> $coloana['RjT_ohm'],
            'Dmj_mm'=> $coloana['Dmj_mm'],
            'Lmed_mm'=> $coloana['Lmed_mm'],
            'scond_mm2'=> $coloana['scond_mm2'],
            'dc_calc_mm' => $coloana['dc_calc_mm'],
            'dc_ales_mm' =>$coloana['dc_ales_mm'],
            'aj_mm' => $coloana['aj_mm']
        ]);

    }
}
