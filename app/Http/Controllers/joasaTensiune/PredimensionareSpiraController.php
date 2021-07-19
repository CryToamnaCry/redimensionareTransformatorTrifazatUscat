<?php

namespace App\Http\Controllers\joasaTensiune;

use App\Models\DateNominale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PredimensionareColoana;
use App\Models\PredimensionareSpiraJT;

class PredimensionareSpiraController extends Controller
{
    public function predimensionareSpira(Request $request)
    {
        $dateNominale = DateNominale::latest()->where('user_id',$request->user()->id)->first();
        $f = $dateNominale->f_Hz;
        $id = $dateNominale->id;
        $u2f = $dateNominale->u2n_V;
        $coloana = PredimensionareColoana::latest()->where('nominales_id',$id)->first();
        $BC = $coloana->BC;
        $AC = $coloana->AC_mp;
        
        //////
        //usp - tensiunea pe spira
        $usp1=pi()*$f*sqrt(2)*$BC*$AC; //V
        //wj - numarul de spire pe JT
        $wj = round($u2f/$usp1);
        $usp_V = $u2f/$wj;

        $spiraJT= array( 
            'dateNominales_id'=>$id,
            'wj_spire'=>$wj,
            'usp_V'=>$usp_V,
        );
        
       
        return $spiraJT;
    }
    public function store(Request $request)
    {
        $coloana = $this->predimensionareSpira($request);
     
        PredimensionareSpiraJT::create([
            'nominale_id'=>$coloana['dateNominales_id'],
            'wj_spire'=>$coloana['wj_spire'],
            'usp_V'=>$coloana['usp_V'],
        ]);

    }
}
