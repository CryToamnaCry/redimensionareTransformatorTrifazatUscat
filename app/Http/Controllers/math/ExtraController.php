<?php

namespace App\Http\Controllers\math;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExtraController extends Controller
{
    public static function pCu()
    {
        return 0.022;//ohm*mm^2 / m
    }

    public static function canalDeRacire($aj_mm,$nrStraturi,$diz,$D_mm,$aoj_mm,$wj,$s_cond_mm2,$I2f,$HBj_m)
    {
        
        $recalcular = $this->recalculare($aj_mm,$nrStraturi,$diz,$D_mm,$aoj_mm,$wj,$s_cond_mm2,$I2f,$HBj_m);

        if($recalcular['gjT_Wperm2'] >= 450){
            $aj_mm=$aj_mm+4;
            $recalcular = $this->recalculare($aj_mm,$nrStraturi,$diz,$D_mm,$aoj_mm,$wj,$s_cond_mm2,$I2f,$HBj_m);
        }else{
            return $recalcular;
        }
    }

    public function recalculare($aj_mm,$nrStraturi,$diz,$D_mm,$aoj_mm,$wj,$s_cond_mm2,$I2f,$HBj_m){

        //HBj - Inaltimea bobinajului jT
        $HBj_m = ( $spireStrat/$nrStraturi+1)*$diz;
        //aj- latimea bobinajului jT
        $aj_mm = ($nrStraturi*$diz)+$aci;//mm
        //Dmj - diametrul mediu JT
        $Dmj_mm = $D_mm + 2*$aoj_mm+ $aj_mm;
        //LMed - lungimea medie a spirei
        $LMed_m = (pi()*$Dmj_mm)*0.001;
        //$Rjt - rezistenta infasurarii JT
        $Rjt_ohm = $this->pCu()*(($wj*$LMed_m)/$s_cond_mm2);
        //PjT -  pierderile Joule jT
        $PjT_W = 3*$Rjt_ohm *pow($I2f,2);
        //gjt - densitatea de cedare a caldurii
        $gjT_Wperm2  = $PjT_W/(3*4*$HBj_m*$LMed_m);

        return array( 
            'aj_mm'=>$aj_mm,
            'Dmj_mm'=>$Dmj_mm,
            'LMed_m'=>$LMed_m,
            'Rjt_ohm'=>$Rjt_ohm,
            'PjT_W'=>$PjT_W,
            'qjT_Wperm2'=>$gjT_Wperm2,
            'HBj_m'=>$HBj_m         
        );
    }
}
