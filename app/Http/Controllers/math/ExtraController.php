<?php

namespace App\Http\Controllers\math;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExtraController extends Controller
{
    public static function pCu()
    {
        return 0.022;//ohm*mm^2 / m
    }
}
