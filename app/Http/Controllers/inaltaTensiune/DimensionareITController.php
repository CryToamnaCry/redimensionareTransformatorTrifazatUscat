<?php

namespace App\Http\Controllers\inaltaTensiune;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DimensionareITController extends Controller
{
    public function predimensionare(Request $request)
    {
        $KT = $U1f/$U2f;
        $wi = ($wj/$U2f)*$U1f;
        $wi =round($wi);
        $wiTotal = $wi*1.05;

        $kw = $wi/$wj;
        $E = (($KT-$kw)/$KT)*100;

        $PiT_W = $Pscn-$PjT;
        $RiT_ohm = $PiT/(3*pow($I1f,2));

        $ai = 
        $Dmi_mm2 = ($D_mm+2*$aoj+2*$aj+$ai);
        $lMed_iT_m = (pi()* $Dmi_mm2)*0.001;

        $Scond_iT_mm2 = ($P_Cu*$wi*$lMed_iT_m)/$RiT;
        $dci = sqrt((4*$Scond_iT_mm2)/pi());
    }

    public function dimensionare()
    {

    }

    public function store()
    {

    }

}
