<?php

namespace App\Http\Controllers\inaltaTensiune;

use App\Models\DateNominale;
use App\Models\MarimiDeFaza;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PredimensionareColoana;
use App\Models\PredimensionareSpiraJT;
use App\Models\joasaTensiune\DimensionareJT;
use App\Models\inaltaTensiune\DimensionareIT;
use App\Http\Controllers\math\ExtraController;
use App\Http\Controllers\math\MathStuffController;
use Cartalyst\Converter\Laravel\Facades\Converter;
use App\Http\Controllers\STAS\DiametruConductorController;
use App\Http\Controllers\STAS\DistanteDeIzolatieController;
use App\Models\joasaTensiune\PredeterminareSectiuneConductorJT;
use App\Http\Controllers\STAS\GrosimeaIzolatieiConductoruluiController;

class DimensionareITController extends Controller
{
    public function predimensionare(Request $request)
    {

        $dateNominale = DateNominale::latest()->where('user_id',$request->user()->id)->first();
            $id = $dateNominale->id;
            $U2f = $dateNominale->u2n_V;
            $U1f = $dateNominale->u1n_V;
            $Pscn_W = $dateNominale->pscn_W;

        $faza = MarimiDeFaza::latest()->where('nominale_id',$id)->first();
            $I1f = $faza->i1f;
            $I2f = $faza->i2f;

        $spira = PredimensionareSpiraJT::latest()->where('nominale_id',$id)->first();
            $wj = $spira->wj_spire;

        $predimensionareJT = PredeterminareSectiuneConductorJT::latest()->where('nominale_id',$id)->first();
            $PjT_W = $predimensionareJT->PjT_W;
            $ai_mm = $predimensionareJT->aj_mm;

        $coloana = PredimensionareColoana::latest()->where('nominale_id',$id)->first();
            $D_mm = Converter::from('length.m')->to('length.mm')->convert($coloana->D_m)->getValue();

        $uIncerc = DistanteDeIzolatieController::transformatorUscatUIncercare($U2f);
        $distanteDeIzolatie = DistanteDeIzolatieController::transformatorUscatJT($uIncerc);
            $aoj_mm = Converter::from('length.m')->to('length.mm')->convert($distanteDeIzolatie['aoj'])->getValue();
        
        $JT = DimensionareJT::latest()->where('nominale_id',$id)->first();
            $HBj_mm = Converter::from('length.m')->to('length.mm')->convert($JT ->HBj_m)->getValue();
            $aj_mm = $JT ->aj_mm;
/////////////////////////////////////////////////////
        $KT = $U1f/$U2f;
        $wi = ($wj/$U2f)*$U1f;
        $wi =ceil($wi);
        
        $wiTotal = $wi*1.05;
        
        $kw = $wi/$wj;
        $E = (($KT-$kw)/$KT)*100;
        
        $PiT_W = $Pscn_W-$PjT_W;
        $RiT_ohm = $PiT_W/(3*pow($I1f,2));
        
        $Dmi_mm2 = ($D_mm+2*$aoj_mm+2*$aj_mm+$ai_mm);
        $lMed_iT_m = (pi()* $Dmi_mm2)*0.001;
        
        $Scond_iT_mm2 = (ExtraController::pCu()*$wi*$lMed_iT_m)/$RiT_ohm;
        $dci = sqrt((4*$Scond_iT_mm2)/pi());

        return array( 
            'nominale_id'=>$dateNominale->id,
            'wiTotal' => $wiTotal,
            'wi'=> $wi,
            'E' =>$E,
            'aoj_mm' => $aoj_mm,
            'D_mm' => $D_mm,
            'I2f' => $I2f,
            'HBj_mm' =>$HBj_mm
        );
    }

    public function dimensionare(Request $request)
    {
        $predimensionare = $this->predimensionare($request);
        $wiTotal = $predimensionare['wiTotal'];
        $wi = $predimensionare['wi'];
        $aoj_mm= $predimensionare['aoj_mm'];
        $D_mm = $predimensionare['D_mm'];
        $I2f = $predimensionare['I2f'];
        $HBj_mm = $predimensionare['HBj_mm'];

        $STAS_giz_mm = GrosimeaIzolatieiConductoruluiController::giz_mm();
        $STAS_dci_mm = DiametruConductorController::dc_stas_mm();        


///////////////////////////////////////////////////////
        $dciTotale = $STAS_giz_mm+$STAS_dci_mm;
        $Sci = (Pi()*pow($STAS_dci_mm,2))/4;

        $nrSpire = MathStuffController::round_5(($HBj_mm/($STAS_dci_mm+0.3))-1);
        $nrStraturi = ceil($wiTotal / $nrSpire);
    
        $ai_mm = $dciTotale*$nrStraturi;
        
        //verificam daca e nevoie sau nu sa adaugam canal de racire 
        $redimensionare = ExtraController::canalDeRacire($aoj_mm,$ai_mm,$nrSpire,$dciTotale,$D_mm,$wi,$Sci,$I2f);

        $redimensionare+=[
            'nominale_id'=>$predimensionare['nominale_id'],
            'wi' => $wi,
            'E' => $predimensionare['E'],
            'wiTotal' => $wiTotal,
            'nrSpirel' => $nrSpire,
            'nrStraturi' => $nrStraturi,      
        ];

      
        return $redimensionare;
    }

    public function store(Request $request)
    {
        $IT = $this->dimensionare($request);
//dd($IT);
        $contents_arr = DimensionareIT::updateOrCreate([
            'nominale_id' =>$IT['nominale_id'] 
        ],[
            'nominale_id' => $IT['nominale_id'],
            'ai_mm'=> $IT['aj_mm'],
            'RiT_ohm'=> $IT['Rjt_ohm'],
            'Dmi_mm'=> $IT['Dmj_mm'],
            'Lmed_mm'=> $IT['LMed_m'],
            'PiT_W'=> $IT['PjT_W'],
            'qiT_Wperm2' => $IT['qjT_Wperm2'],
            'HBi_m' => $IT['HBj_m'],
            'wi'=> $IT['wi'],
            'E'=> $IT['E'],
            'wiTotal'=> $IT['wiTotal'],
            'nrSpire'=> $IT['nrSpirel'],
            'nrStraturi'=> $IT['nrStraturi'],
            'msg' => $IT['msg']
        ]);

        if($contents_arr) {
            return response()->json([
                'status' => 'success',
                'data' => $contents_arr
            ]);
        }
        return response()->json([
            'status' => 'fail',
            'message' => 'failed to create content_arr record'
        ]);
            
    }

}
