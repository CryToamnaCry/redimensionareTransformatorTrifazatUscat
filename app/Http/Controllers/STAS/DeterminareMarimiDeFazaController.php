<?php

namespace App\Http\Controllers\STAS;

use App\Models\DateNominale;
use App\Models\MarimiDeFaza;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeterminareMarimiDeFazaController extends Controller
{
    
    public function creareMarimiDeFaza(Request $request)
    {
        $dateNominale = DateNominale::latest()->where('user_id',$request->user()->id)->first();
        $sn = $dateNominale->sn_VA;
        $u1n = $dateNominale->u1n_V;
        $u2n = $dateNominale->u2n_V;
        $infasPrimara = substr($dateNominale->conexiune,0,1);
        $infasSec = substr($dateNominale->conexiune,1,1);
        
        $i1n = $sn/(sqrt(3)*$u1n);
        $i2n = $sn/(sqrt(3)*$u2n);

     
        if($infasPrimara=='D'){
            $u1f = $u1n;
            $i1f = $i1n/sqrt(3);

        }elseif($infasPrimara=='Y'){
            $u1f = ($u1n)/sqrt(3);
            $i1f = $i1n;
        }
        if($infasSec == 'd'){
            $u2f=$u2n;
            $i2f =$i2n/sqrt(3);
        }elseif($infasSec == 'y'){
            $u2f = $u2n/sqrt(3);
            $i2f = $i2n;
        }
        $snVerificare1 = 3*$u1f*$i1f;
        $snVerificare2 = 3*$u2f*$i2f;

        MarimiDeFaza::updateOrCreate([
            'nominale_id' =>$dateNominale->id 
        ],[
            'nominale_id'=>$dateNominale->id,
            'i1f'=>$i1f,
            'i2f'=>$i2f,
            'u1f'=>$u1f,
            'u2f'=>$u2f
        ]);

    }
}
