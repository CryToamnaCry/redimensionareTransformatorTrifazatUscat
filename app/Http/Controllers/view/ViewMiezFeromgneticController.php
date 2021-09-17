<?php

namespace App\Http\Controllers\view;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\miezFeromagnetic\MiezFeromagnetic;

class ViewMiezFeromgneticController extends Controller
{
    public function show($id)
    {
        $miez = MiezFeromagnetic::latest()->where('nominale_id',$id)->first();
        if($miez==NULL){
            return 'nu';
        }else{

        

        $detalii = array (
            'an' =>array (
                'denumire'=>'Dimensionarea trepelor pentru coloana [An]',
                'valoare'=>$miez->TrepteColoana_a_mm,
                'unit'=>'mm'                
            ),
            'bn'=>array (
                'denumire'=>'Dimensionarea trepelor pentru jug[Bn]',
                'valoare'=>$miez->TrepteJug_b_mm,
                'unit'=>'mm'                
            ),
            'bv'=>array (
                'denumire'=>'Inductia in coloanal[Bc]',
                'valoare'=>$miez->Bc_T,
                'unit'=>'T'                
            ),
            'bjug'=>array (
                'denumire'=>'Inductia in jug[Bjug]',
                'valoare'=>$miez->Bjug_T,
                'unit'=>'T'              
            )
          );

        // $detalii = array (
        //     'an' =>array (
        //         'denumire'=>'Dimensionarea trepelor pentru coloana [An]',
        //         'valoare'=>'71 , 64 , 53 , 40 ',
        //         'unit'=>'mm'                
        //     ),
        //     'bn'=>array (
        //         'denumire'=>'Dimensionarea trepelor pentru jug[Bn]',
        //         'valoare'=>'71 , 64 , 53 , 53',
        //         'unit'=>'mm'                
        //     ),
        //     'bv'=>array (
        //         'denumire'=>'Inductia in coloanal[Bc]',
        //         'valoare'=>'1.59',
        //         'unit'=>'T'                
        //     ),
        //     'bjug'=>array (
        //         'denumire'=>'Inductia in jug[Bjug]',
        //         'valoare'=>'1.51',
        //         'unit'=>'T'              
        //     )
        //   );
        return $detalii;
    }}
}
