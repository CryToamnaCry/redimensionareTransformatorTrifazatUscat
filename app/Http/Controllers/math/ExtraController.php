<?php

namespace App\Http\Controllers\math;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\STAS\DistanteDeIzolatieController;

class ExtraController extends Controller
{
    public static function pCu()
    {
        return 0.022;//ohm*mm^2 / m
    }

    public static function canalDeRacire($aoj_mm,$aj_mm,$spireStrat,$diz,$D_mm,$wj,$s_cond_mm2,$I2f)
    {
        $x = 2;
        $msg = 'Nu exista canal de racire';
        do {
            //HBj - Inaltimea bobinajului jT
            $HBj_m = (($spireStrat+1)*$diz)*0.001; //m
            //Dmj - diametrul mediu JT
            $Dmj_mm = $D_mm + 2*$aoj_mm+ $aj_mm;
            //LMed - lungimea medie a spirei
            $LMed_m = (pi()*$Dmj_mm)*0.001;
            //$Rjt - rezistenta infasurarii JT
            $Rjt_ohm = 0.022*(($wj*$LMed_m)/$s_cond_mm2);
            //PjT -  pierderile Joule jT
            $PjT_W = 3*$Rjt_ohm *pow($I2f,2);
            //gjt - densitatea de cedare a caldurii
            $gjT_Wperm2  = $PjT_W/(3*$x*$HBj_m*$LMed_m);

            if($gjT_Wperm2 >= 450){
                $msg = 'Exista canal de racire';
                $aj_mm=$aj_mm+4;
                $x=$x+2;
            }
        }while ($gjT_Wperm2 >= 450);

        return array( 
            'aj_mm'=>$aj_mm,
            'Dmj_mm'=>$Dmj_mm,
            'LMed_m'=>$LMed_m,
            'Rjt_ohm'=>$Rjt_ohm,
            'PjT_W'=>$PjT_W,
            'qjT_Wperm2'=>$gjT_Wperm2,
            'HBj_m'=>$HBj_m,
            'msg'=>$msg,         
        );
    }

}
