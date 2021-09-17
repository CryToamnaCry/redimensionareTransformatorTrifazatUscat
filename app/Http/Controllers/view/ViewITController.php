<?php

namespace App\Http\Controllers\view;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\inaltaTensiune\DimensionareIT;

class ViewITController extends Controller
{
    public function show($id)
    {
        $IT = DimensionareIT::latest()->where('nominale_id',$id)->first();
        if($IT==NULL){
            return 'nu';
        }else{

        $detalii = array (
            'wi' =>array (
                'denumire'=>'Numărul de spire folosit[wi]',
                'valoare'=>$IT->wi,
                'unit'=>'spire'                
            ),'E'=>array (
                'denumire'=>'Eroarea raportului de transformare[Σ]',
                'valoare'=>$IT->E,
                'unit'=>'-'                
            ),
            'wiTotal'=>array (
                'denumire'=>'Numărul de spire total[𝜔î𝑇𝑜𝑡𝑎𝑙]',
                'valoare'=>$IT->wiTotal,
                'unit'=>'spire'                
            ),
            'dc'=>array (
                'denumire'=>'Diametrul conductorul folosit[dcî]',
                'valoare'=>$IT->dci_Mm,
                'unit'=>'Mn'                
            ),
            'spire'=>array (
                'denumire'=>'Numărul de spire pe strat',
                'valoare'=>$IT->nrSpire,
                'unit'=>'spire/strat'                
            ),
            'strat'=>array (
                'denumire'=>'Numărul de straturi',
                'valoare'=>$IT->nrStraturi,
                'unit'=>'strat'              
            ),
            'ai'=>array (
                'denumire'=>'Lățimea bobinajului[ai]',
                'valoare'=>$IT->ai_mm,
                'unit'=>'mm'              
            ),
            'Dm'=>array (
                'denumire'=>'Diametrul mediu[Dmî]',
                'valoare'=>$IT->Dmi_mm,
                'unit'=>'ohm'              
            ),
            'HBi'=>array (
                'denumire'=>'Inălțimea bobinajului[HBî]',
                'valoare'=>$IT->HBi_m,
                'unit'=>'m'              
            ),
            'rezistenta'=>array (
                'denumire'=>'Rezistență unei faze[RîT]',
                'valoare'=>$IT->RiT_ohm,
                'unit'=>'ohm'              
            ),
            'qj'=>array (
                'denumire'=>'Densitatea de cedare a căldurii[qîT]',
                'valoare'=>$IT->qiT_Wperm2,
                'unit'=>'W/m^2'              
            ),
            'pierderi'=>array (
                'denumire'=>'Pierderile Joule[PiT]',
                'valoare'=>$IT->PiT_W,
                'unit'=>'W'              
            ),
            'cabal'=>array (
                'denumire'=>'Canal de racire',
                'valoare'=>$IT->msg,
                'unit'=>'-'              
            )
          );

        // $detalii = array (
        //     'wi' =>array (
        //         'denumire'=>'Numărul de spire folosit[wi]',
        //         'valoare'=>'306',
        //         'unit'=>'spire'                
        //     ),'E'=>array (
        //         'denumire'=>'Eroarea raportului de transformare[Σ]',
        //         'valoare'=>'-0.15',
        //         'unit'=>'-'                
        //     ),
        //     'wiTotal'=>array (
        //         'denumire'=>'Numărul de spire total[𝜔î𝑇𝑜𝑡𝑎𝑙]',
        //         'valoare'=>'322',
        //         'unit'=>'spire'                
        //     ),
        //     'dc'=>array (
        //         'denumire'=>'Diametrul conductorul folosit[dcî]',
        //         'valoare'=>'2.24',
        //         'unit'=>'Mn'                
        //     ),
        //     'spire'=>array (
        //         'denumire'=>'Numărul de spire pe strat',
        //         'valoare'=>'60',
        //         'unit'=>'spire/strat'                
        //     ),
        //     'strat'=>array (
        //         'denumire'=>'Numărul de straturi',
        //         'valoare'=>'6',
        //         'unit'=>'strat'              
        //     ),
        //     'ai'=>array (
        //         'denumire'=>'Lățimea bobinajului[ai]',
        //         'valoare'=>'19.54',
        //         'unit'=>'mm'              
        //     ),
        //     'Dm'=>array (
        //         'denumire'=>'Diametrul mediu[Dmî]',
        //         'valoare'=>'150.116',
        //         'unit'=>'ohm'              
        //     ),
        //     'HBi'=>array (
        //         'denumire'=>'Inălțimea bobinajului[HBî]',
        //         'valoare'=>'132.09',
        //         'unit'=>'m'              
        //     ),
        //     'rezistenta'=>array (
        //         'denumire'=>'Rezistență unei faze[RîT]',
        //         'valoare'=>'0.81',
        //         'unit'=>'ohm'              
        //     ),
        //     'qj'=>array (
        //         'denumire'=>'Densitatea de cedare a căldurii[qîT]',
        //         'valoare'=>'248.78',
        //         'unit'=>'W/m^2'              
        //     ),
        //     'pierderi'=>array (
        //         'denumire'=>'Pierderile Joule[PiT]',
        //         'valoare'=>'185.95',
        //         'unit'=>'W'              
        //     ),
        //     'cabal'=>array (
        //         'denumire'=>'Canal de racire',
        //         'valoare'=>$IT->msg,
        //         'unit'=>'-'              
        //     )
        //   );
        return $detalii;
    }}
}
