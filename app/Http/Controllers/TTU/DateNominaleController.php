<?php

namespace App\Http\Controllers\TTU;

use App\Models\DateNominale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Converter\Laravel\Facades\Converter;
use App\Http\Controllers\TTU\DateNominaleController;
use App\Http\Controllers\TTU\RedimensionareFinalaController;
use App\Http\Controllers\TTU\S1CalcululMarimilorDeFazaController;


class DateNominaleController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        $measurements = Converter::getMeasurements();

        return view('TTU.dateNominale',[
            'putereAparentaUnits' => array_keys($measurements['putereAparenta']),
            'putereRealaUnits' => array_keys($measurements['putereReala']),
            'curentUnits' => array_keys($measurements['curent']),
            'voltageUnits' => array_keys($measurements['voltage']),
            'frequencyUnits'=> array_keys($measurements['frequency']),

        ]);
  
    }
    public function store(Request $request)
    {
         //validate data
         $this->validate($request, [
            'sn' => 'required|max:255|numeric',
            'f' => 'required|max:500|numeric',
            'u1n' => 'required|max:255|numeric',
            'u2n' => 'required|max:255|numeric',
            'sc1conex' => 'required|max:1',
            'sc2conex' => 'required|max:1',
            'grConex' => 'required|max:12|numeric',
            'uscn' => 'required|max:255|numeric',
            'pscn' => 'required|max:255|numeric',
    
        ]);


        //store data
        DateNominale::create([
            'user_id' => $request->user()->id,

            'sn' => Converter::from('putereAparenta'.'.'.$request->snUnit)->to('putereAparenta.VA')->convert($request->sn)->getValue(),

            'f'=>Converter::from('frequency'.'.'.$request->fUnit)->to('frequency.Hz')->convert($request->f)->getValue(),

            'u1n'=>Converter::from('voltage'.'.'.$request->u1nUnit)->to('voltage.V')->convert($request->u1n)->getValue(),

            'u2n'=>Converter::from('voltage'.'.'.$request->u2nUnit)->to('voltage.V')->convert($request->u2n)->getValue(),

            'conexiune'=>$request->sc1conex.$request->sc2conex.$request->grConex,

            'uscn'=>$request->uscn,

            'pscn'=>Converter::from('putereReala'.'.'.$request->pscnUnit)->to('putereReala.W')->convert($request->pscn)->getValue(),

        ]);

     $marimiDeFaza = new S1CalcululMarimilorDeFazaController;
     $marimiDeFaza->creareMarimiDeFaza($request);

        return Redirect::action('App\Http\Controllers\TTU\RedimensionareFinalaController@index');

    }
}
