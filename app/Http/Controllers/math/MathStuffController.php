<?php

namespace App\Http\Controllers\math;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MathStuffController extends Controller
{

    public static function NRoot($number, $nthRoot)
    {
        return pow($number, (1/$nthRoot));
    }

    public static function round_5($in)
    {
    return round(($in*2)/10)*5;
    }
    public static function get_nearest_multiple( $number, $near ) 
    { 
     $nearest = round($number/$near)*$near;
       
     return $nearest;
    }

    public static function multiply_by_index(&$array1, &$array2) 
    {
    $temp =array(); 
    $i=0; 
    while($i<count($array1)){
        $temp[$i] = $array1[$i] * $array2[$i];
        $i++;
    }

    return $temp;
    }
}
