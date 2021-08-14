<?php

namespace App\Http\Controllers\miezFeromagnetic;

use App\Models\DateNominale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PredimensionareColoana;
use App\Models\PredimensionareSpiraJT;
use App\Models\joasaTensiune\DimensionareJT;
use App\Models\inaltaTensiune\DimensionareIT;
use App\Http\Controllers\math\ExtraController;
use App\Models\miezFeromagnetic\MiezFeromagnetic;
use App\Http\Controllers\math\MathStuffController;
use Cartalyst\Converter\Laravel\Facades\Converter;
use App\Http\Controllers\STAS\DistanteDeIzolatieController;

class MiezFeromagneticController extends Controller
{
    public function create(Request $request)
    {
        $dateNominale = DateNominale::latest()->where('user_id',$request->user()->id)->first();
            $id = $dateNominale->id;
            $U2f = $dateNominale->u2n_V;
            $f_Hz = $dateNominale->f_Hz;

        $coloana = PredimensionareColoana::latest()->where('nominale_id',$id)->first();
            $D_mm = Converter::from('length.m')->to('length.mm')->convert($coloana->D_m)->getValue();

        $spira = PredimensionareSpiraJT::latest()->where('nominale_id',$id)->first();
            $wj = $spira->wj_spire;
        
        $JT = DimensionareJT::latest()->where('nominale_id',$id)->first();
            $HBj_mm = Converter::from('length.m')->to('length.mm')->convert($JT ->HBj_m)->getValue();
            $aj_mm = $JT->aj_mm;

        $IT = DimensionareIT::latest()->where('nominale_id',$id)->first();
            $ai_mm = $IT->ai_mm;

        $distanteDeIzolatie = DistanteDeIzolatieController::transformatorUscatJT();
            $loj_mm = Converter::from('length.m')->to('length.mm')->convert($distanteDeIzolatie['loj'])->getValue();
            $aoj_mm = Converter::from('length.m')->to('length.mm')->convert($distanteDeIzolatie['aoj'])->getValue();

        $uIncerc = DistanteDeIzolatieController::transformatorUscatUIncercare($U2f);
        $distanteDeIzolatie = DistanteDeIzolatieController::transformatorUscatIT($uIncerc);
            $aji_mm =  Converter::from('length.m')->to('length.mm')->convert($distanteDeIzolatie['aji'])->getValue();
            $aii_mm =  Converter::from('length.m')->to('length.mm')->convert($distanteDeIzolatie['aii'])->getValue();
///////////////////////////////////////////////////////////////////////////////

//1. SECTIUNEA COLOANEI
      $x  = array();  
    //Nr trepte
    if($D_mm<=90&&$D_mm>=80){
        //3 trepte
        $x = array(0.905,0.707,0.42);
    }else if($D_mm>90&&$D_mm<=100){
        //4 trepte
        $x = array(0.935,0.8,0.6,0.355);
    }else if($D_mm>100&&$D_mm<=120){
        //5 trepte
        $x = array(0.95,0.847,0.707,0.532,0.312);
    }else if($D_mm>120&&$D_mm<=140){
        //6 trepte
        $x = array(0.96,0.885,0.775,0.631,0.465,0.28);
    }
    if($x){
        foreach($x as $values)
            $a[] = $values*$D_mm;
    }
    ////
    $b = array(); 
    
    foreach($a as  $indexKey =>$an){
        $b[$indexKey]= sqrt(pow(($D_mm/2),2)-pow(($an/2),2))-array_sum($b);
        if($b[$indexKey]%1.05 !=0){
            $b[$indexKey]= MathStuffController::get_nearest_multiple($b[$indexKey],(2*0.35));
        } 
    }

    //aria coloanei
    $Ac_mm2 = 2*ExtraController::kFe()*array_sum(MathStuffController::multiply_by_index($a,$b));
    //inductia campului magnetic care se stabileste in coloana
    $usp_V = $U2f/$wj;
    $Bc_T = $usp_V/(sqrt(2)*pi()*$f_Hz*$Ac_mm2**10^-6);//T
    //sectiunea jugului 
    $slicea = array_slice($a,0, count($a)-1);
    $sliceb = array_slice($b,0, count($b)-1);

    $Ajug_mm2 = ExtraController::kFe()*2*array_sum(MathStuffController::multiply_by_index($slicea,$sliceb));
    $Bjug_T = ($Bc_T*$Ac_mm2*10^-6)/($Ajug_mm2*10^-6);

    //2. INALTIMEA COLOANEI
    $H_mm = $HBj_mm+2*$loj_mm+2*$a[0]/2;

    //3. Lungimea jugului
    $F_mm =2*($aoj_mm+$aj_mm+$aji_mm+$ai_mm)+$aii_mm; 
    $L_mm = 2*$a[0]+2*$F_mm;

    //4. VOLUMUL COLOANELOR
    $Vcol_kg = 3*($Ac_mm2*10^-6)*($H_mm*10^-6);
    $Mcol_kg = 7650*$Vcol_kg;

    //5.VOLUM JUG
    $Vjug_kg = 2*($Ajug_mm2*10^-6)*($L_mm*10^-6);
    $Mjug_kg = 7650*$Vjug_kg;
    

     $db= array(
    'nominale_id'=>$id,
    'TrepteColoana_a_mm'=>$a,
    'TrepteJug_b_mm'=>$b,
    'Bc_T'=>$Bc_T,
    'Bjug_T'=>$Bjug_T,
    'H_mm'=>$H_mm,
    'L_mm'=>$L_mm,
    'Mcol_kg'=>$Mcol_kg,
    'Mjug_kg'=>$Mjug_kg
    );

    return $db;
    }

    public function store(Request $request)
    {
        $miez = $this->create($request);
        MiezFeromagnetic::updateOrCreate([
            'nominale_id' =>$miez['nominale_id'] 
        ],[
            'nominale_id'=>$miez['nominale_id'],
            'TrepteColoana_a_mm'=>implode(",", $miez['TrepteColoana_a_mm']),
            'TrepteJug_b_mm'=>implode(",", $miez['TrepteJug_b_mm']),
            'Bc_T'=>$miez['Bc_T'],
            'Bjug_T'=>$miez['Bjug_T'],
            'H_mm'=>$miez['H_mm'],
            'L_mm'=>$miez['L_mm'],
            'Mcol_kg'=>$miez['Mcol_kg'],
            'Mjug_kg'=>$miez['Mjug_kg']
        ]);

    }

}
