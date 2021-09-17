<?php

namespace App\Http\Controllers\view;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PredimensionareSpiraJT;
use App\Models\joasaTensiune\DimensionareJT;
use App\Models\joasaTensiune\PredeterminareSectiuneConductorJT;

class ViewJSController extends Controller
{
    public function show($id)
    {
        
    
        $predimJT = PredeterminareSectiuneConductorJT::latest()->where('nominale_id',$id)->first();
        if($predimJT==NULL){
            return 'nu';
        }else{
        $JT = DimensionareJT::latest()->where('nominale_id',$id)->first();
     
        $detalii = array (
            'wj' =>array (
                'denumire'=>'Numărul de spire folosit[wj]',
                'valoare'=>$JT->wj,
                'unit'=>'spire'                
            ),
            'dc'=>array (
                'denumire'=>'Diametrul conductorul folosit[dc]',
                'valoare'=>$predimJT->dc_ales_mm,
                'unit'=>'Mn'                
            ),
            'spire'=>array (
                'denumire'=>'Numărul de spire pe strat',
                'valoare'=>$JT->spireStrat,
                'unit'=>'spire/strat'                
            ),
            'strat'=>array (
                'denumire'=>'Numărul de straturi',
                'valoare'=>$JT->nrStraturi,
                'unit'=>'strat'              
            ),
            'aj'=>array (
                'denumire'=>'Lățimea bobinajului[aj]',
                'valoare'=>$JT->aj_mm,
                'unit'=>'mm'              
            ),
            'HBj'=>array (
                'denumire'=>'Inălțimea bobinajului[HBj]',
                'valoare'=>$JT->HBj_m,
                'unit'=>'m'              
            ),
            'dm'=>array (
                'denumire'=>'Diametrul mediu[Dmj]',
                'valoare'=>$JT->Dmj_mm,
                'unit'=>'mm'              
            ),
            'rezistenta'=>array (
                'denumire'=>'Rezistența[RjT]',
                'valoare'=>$JT->Rjt_ohm,
                'unit'=>'ohm'              
            ),
            'qj'=>array (
                'denumire'=>'Densitatea de cedare a căldurii[qj]',
                'valoare'=>$JT->qjT_Wperm2,
                'unit'=>'W/m^2'              
            ),
            'pierderi'=>array (
                'denumire'=>'Pierderile Joule[PjT]',
                'valoare'=>$JT->PjT_W,
                'unit'=>'W'              
            ),
            'pierderi'=>array (
                'denumire'=>'Canal de racire',
                'valoare'=>$JT->msg,
                'unit'=>'-'              
            )
          );
        // $detalii = array (
        //     'wj' =>array (
        //         'denumire'=>'Numărul de spire folosit[wj]',
        //         'valoare'=>'201',
        //         'unit'=>'spire'                
        //     ),
        //     'dc'=>array (
        //         'denumire'=>'Diametrul conductorul folosit[dc]',
        //         'valoare'=>'2.5',
        //         'unit'=>'Mn'                
        //     ),
        //     'spire'=>array (
        //         'denumire'=>'Numărul de spire pe strat',
        //         'valoare'=>'55',
        //         'unit'=>'spire/strat'                
        //     ),
        //     'strat'=>array (
        //         'denumire'=>'Numărul de straturi',
        //         'valoare'=>'4',
        //         'unit'=>'strat'              
        //     ),
        //     'aj'=>array (
        //         'denumire'=>'Lățimea bobinajului[aj]',
        //         'valoare'=>'15.4',
        //         'unit'=>'mm'              
        //     ),
        //     'HBj'=>array (
        //         'denumire'=>'Inălțimea bobinajului[HBj]',
        //         'valoare'=>'159.6',
        //         'unit'=>'mm'              
        //     ),
        //     'dm'=>array (
        //         'denumire'=>'Diametrul mediu[Dmj]',
        //         'valoare'=>'110.4',
        //         'unit'=>'mm'              
        //     ),
        //     'rezistenta'=>array (
        //         'denumire'=>'Rezistența[RjT]',
        //         'valoare'=>'0.35',
        //         'unit'=>'ohm'              
        //     ),
        //     'qj'=>array (
        //         'denumire'=>'Densitatea de cedare a căldurii[qj]',
        //         'valoare'=>'281.99',
        //         'unit'=>'W/m^2'              
        //     ),
        //     'pierderi'=>array (
        //         'denumire'=>'Pierderile Joule[PjT]',
        //         'valoare'=>'187.31',
        //         'unit'=>'W'              
        //     ),
        //     'pierderi'=>array (
        //         'denumire'=>'Canal de racire',
        //         'valoare'=>$JT->msg,
        //         'unit'=>'-'              
        //     )
        //   );
        return $detalii;
    }}
}
