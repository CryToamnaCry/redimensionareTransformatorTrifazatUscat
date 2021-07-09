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

    
}
