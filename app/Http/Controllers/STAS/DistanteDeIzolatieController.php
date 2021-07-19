<?php

namespace App\Http\Controllers\STAS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cartalyst\Converter\Laravel\Facades\Converter;

class DistanteDeIzolatieController extends Controller
{
    public static function transformatorUscatUIncercare($Un)
    {
        //tensiunile de incarcare pentru frecvente de 50Hz,in functie de tensiunile de linie
        if($Un<=550) //V
        {
            $UIncercare=2500;
        }elseif($Un>550 && $Un<=1000)
        {
            $UIncercare=3000;
        }elseif($Un>1000 && $Un<=3000)
        {
            $UIncercare=10000;
        }elseif($Un>3000 && $Un<=6000)
        {
            $UIncercare=16000; 
        }elseif($Un>6000 && $Un<=10000)
        {
            $UIncercare=23000; 
        }
        return $UIncercare;//V
    }

    public  static function transformatorUscatJT(){
        //Distante de izolare pt joasa tensiune si UIncercare=3kV
        $joasaTensiune=array(
            "loj" => Converter::from('length.mm')->to('length.m')->convert(1.5)->getValue(),
            "g_oj" => Converter::from('length.mm')->to('length.m')->convert(1)->getValue(),
            //2*0.5carton mm
            "aoj" => Converter::from('length.mm')->to('length.m')->convert(10)->getValue(),
        );
    return $joasaTensiune;
    }

    public static function transformatorUscatIT($UIncercare){
        //Distanta de izolare pentru inalta tensiune
        if($UIncercare<=3000)//Un[V]
        { 
            $intaltaTensiune = array(
                "loi" => Converter::from('length.mm')->to('length.m')->convert(15)->getValue(),
                "g_oi" => Converter::from('length.mm')->to('length.m')->convert(1)->getValue(),
                //2*0.5carton mm
                "aji" => Converter::from('length.mm')->to('length.m')->convert(10)->getValue(),
                "aii" => Converter::from('length.mm')->to('length.m')->convert(10)->getValue(),
            );
        }elseif($UIncercare<=10000 && $UIncercare>3000)
        {
            $intaltaTensiune = array(
                "loi" => Converter::from('length.mm')->to('length.m')->convert(20)->getValue(),
                "g_oi" => Converter::from('length.mm')->to('length.m')->convert(2.5)->getValue(),
                "aji" => Converter::from('length.mm')->to('length.m')->convert(15)->getValue(),
                "aii" => Converter::from('length.mm')->to('length.m')->convert(10)->getValue(),
            );
        }elseif($UIncercare<=16000 && $UIncercare>10000)
        {
            $intaltaTensiune = array(
                "loi" => Converter::from('length.mm')->to('length.m')->convert(45)->getValue(),
                "g_oi" => Converter::from('length.mm')->to('length.m')->convert(4)->getValue(),
                "aji" => Converter::from('length.mm')->to('length.m')->convert(22)->getValue(),
                "aii" => Converter::from('length.mm')->to('length.m')->convert(25)->getValue(),
            );
        }
       
        return $intaltaTensiune;
        
    }
    // public function transformatorInUleiUIncercare($Un)
    // {
    //     //tensiunile de incarcare pentru frecvente de 50Hz,in functie de tensiunile de linie
    //     if($Un<=1000) //V
    //     {
    //         $UIncercare=1000;
    //     }elseif($Un>1000 && $Un<=3000)
    //     {
    //         $UIncercare=16000;
    //     }elseif($Un>3000 && $Un<=6000)
    //     {
    //         $UIncercare=22000;
    //     }elseif($Un>6000 && $Un<=10000)
    //     {
    //         $UIncercare=28000; 
    //     }elseif($Un>10000 && $Un<=15000)
    //     {
    //         $UIncercare=38000; 
    //     }
    //     return $UIncercare;//V
    // }

    // public function transformatorInUleiJT(){
    //     //Distante de izolare pt joasa tensiune si UIncercare=5kV
    //     $joasaTensiune=array(
    //         "loj" => Converter::from('length.mm')->to('length.m')->convert(1.5)->getValue(),
    //         "g_oj" => Converter::from('length.mm')->to('length.m')->convert(1)->getValue(),
    //         //2*0.5carton mm
    //         "aoj" => Converter::from('length.mm')->to('length.m')->convert(4)->getValue(),
    //     );
    //     return $joasaTensiune;
    // }
    // public function transformatorInUleiIT($sn){
    //     //Distante de izolare pt joasa tensiune si UIncercare=18-28kV
    //     if($sn>=25000 && $sn<=100000)//Sn[VA]
    //     { 
    //         $intaltaTensiune = array(
    //             "loi" => Converter::from('length.mm')->to('length.m')->convert(20)->getValue(),
    //             "aci" => Converter::from('length.mm')->to('length.m')->convert(3)->getValue(),
    //             "aji" => Converter::from('length.mm')->to('length.m')->convert(9)->getValue(),
    //             //2*0.5carton mm
    //             "aii" => Converter::from('length.mm')->to('length.m')->convert(8)->getValue(),
    //         );
    //     }elseif($sn>=160000 && $sn<=630000)
    //     {
    //         $intaltaTensiune = array(
    //             "loi" => Converter::from('length.mm')->to('length.m')->convert(30)->getValue(),
    //             "aci" => Converter::from('length.mm')->to('length.m')->convert(3)->getValue(),
    //             "aji" => Converter::from('length.mm')->to('length.m')->convert(9)->getValue(),
    //             //2*0.5carton mm
    //             "aii" => Converter::from('length.mm')->to('length.m')->convert(10)->getValue(),
    //         );
    //     }
       
    //     return $intaltaTensiune;  
    // }

   

}

