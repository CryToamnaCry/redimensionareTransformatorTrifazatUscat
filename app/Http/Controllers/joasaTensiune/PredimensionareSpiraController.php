<?php

namespace App\Http\Controllers\joasaTensiune;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PredimensionareSpiraController extends Controller
{
    public function redimensionareSpira()
    {
        $dateNominale = DateNominale::latest()->where('user_id',$request->user()->id)->first();
        $f = $dateNominale->f;
        //////
        $usp=(2*pi()*$f)/sqrt(2);
       
    }
}
