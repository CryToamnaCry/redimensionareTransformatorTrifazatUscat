<?php

namespace App\Http\Controllers\coloana;

use App\Models\DateNominale;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\PredimensionareColoana;
use App\Http\Controllers\math\MathStuffController;
use Cartalyst\Converter\Laravel\Facades\Converter;
use App\Http\Controllers\STAS\DistanteDeIzolatieController;



class PredimensionareColoanaController extends Controller
{
    
    public function estimareDimensioniColoana(Request $request)
    {
        $dateNominale = DateNominale::latest()->where('user_id',$request->user()->id)->first();

        $sn = $dateNominale->sn_VA;
        $pscn =$dateNominale->pscn_W;
        $uscn = $dateNominale->uscn;
        $u2n = $dateNominale->u2n_V;
        $factorForma = $dateNominale->factorForma;
        $f = $dateNominale->f_Hz;

        $uIncerc = DistanteDeIzolatieController::transformatorUscatUIncercare($u2n);
        $distanteDeIzolatie = DistanteDeIzolatieController::transformatorUscatIT($uIncerc);
        $aji = $distanteDeIzolatie['aji'];
        ///////////////////////////////////////////
        //
        //Estimare dimensiune estimareDimensioniColoana
        //      
        ///////////////////////////////////////////
    
        //putere pe o coloana
        $sc=$sn/3;
        // usca - componenta activa a tensiunii de scurtcircuit 
        $usca = ($pscn/$sn)*100;
        // uscr - componenta reactiva a tensiunii de scurtrcircuit
        //uscn - tensiunea de scurtcircuit
        $uscr = sqrt(pow($uscn,2)-pow($usca,2)); //[%]
       
        // al -latimea echivalenta a canalului de dispersie 
        $sc_kVA =  Converter::from('putereAparenta.VA')->to('putereAparenta.kVA')->convert($sc)->getValue();
        $sum_ajai= 3*0.6*MathStuffController::NRoot($sc_kVA,4);//cm
        
        $aji_cm = Converter::from('length.m')->to('length.cm')->convert($aji)->getValue();
        $al = $aji_cm +($sum_ajai/3);//cm
        
        // kr - factorul de dispersie (Rogowski) //intre 0.93 , 0.95 , 0.97
        $kr = 0.95;
        // km - factorul de umplere a coloanei (kg(=factor de geometrie)*kFe()
        $km = 0.95*0.9;//
        //BC - inductia in coloana [1.5...1.55] T
        $BC = 1.5;
        // D - diametru coloana
        $d1 = ($sc_kVA*$factorForma*$al*$kr)/($f*$uscr*pow($km,2)*pow($BC,2));
        $d2 = 16*MathStuffController::NRoot($d1,4); //cm

        $D_mm =round(Converter::from('length.cm')->to('length.mm')->convert($d2)->getValue(),-1) ;//mm STAS
        $D_m = Converter::from('length.mm')->to('length.m')->convert($D_mm)->getValue();

           // ac [m^2] - aria coloanei
           $ac = $km*(pi()*pow($D_m,2))/4;

           $coloana= array( 
            'dateNominales_id'=>$dateNominale->id,
            'sc_VA'=>$sc,
            'usca'=>$usca,
            'uscr'=>$uscr,
            'km'=>$km,
            'al_cm'=>$al,
            'sum_ajai_cm'=>$sum_ajai,
            'BC'=>$BC,
            'D_m'=>$D_m,
            'AC_mp'=>$ac
            
        );
    
        return $coloana;
        
    }

    public function store(Request $request)
    {

        $coloana = $this->estimareDimensioniColoana($request);
     

        PredimensionareColoana::create([
            'nominales_id'=>$coloana['dateNominales_id'],
            'sc_VA' => $coloana['sc_VA'],
            'usca'=>$coloana['usca'],
            'uscr'=>$coloana['uscr'],
            'km'=>$coloana['km'],
            'al_cm'=>$coloana['al_cm'],
            'sum_ajai_cm'=>$coloana['sum_ajai_cm'],
            'BC'=>$coloana['BC'],
            'D_m'=>$coloana['D_m'],
            'AC_mp'=>$coloana['AC_mp'],
        ]);
    }
}
