<?php

namespace App\Http\Controllers\view;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PredimensionareColoana;

class ViewDiametrulColoaneiController extends Controller
{
    public function show($id)
    {
        $val = PredimensionareColoana::latest()->where('nominale_id',$id)->first();
        if($val==NULL){
return 'nu';
        }else{

        $val = array (array (
            'denumire'=>'Diametrul coloanei',
            'valoare'=>$val->D_m,
            'unit'=>'m'                
        ));
        return $val;
    }
}
}
