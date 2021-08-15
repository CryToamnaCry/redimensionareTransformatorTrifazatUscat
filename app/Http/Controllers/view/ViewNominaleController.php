<?php

namespace App\Http\Controllers\view;

use App\Models\DateNominale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewNominaleController extends Controller
{
    public function show($id)
    {
        $dateNominale = DateNominale::latest()->where('user_id',$id)->first();
        if($dateNominale==NULl){
            return $detalii = 'nu';
        }else{
     
        $detalii = array (
            'sn' =>array (
                'denumire'=>'Putere nominala',
                'valoare'=>$dateNominale->sn_VA,
                'unit'=>'VA'                
            ),
            'un'=>array (
                'denumire'=>'Tensiuni nominale',
                'valoare'=>$dateNominale->u1n_V.' / '.$dateNominale->u2n_V,
                'unit'=>'V'                
            ),
            'f'=>array (
                'denumire'=>'Frecventa tensiunii de alimentare',
                'valoare'=>$dateNominale->f_Hz,
                'unit'=>'Hz'                
            ),
            'conex'=>array (
                'denumire'=>'Schema și grupa de conexiuni',
                'valoare'=>$dateNominale->conexiune,
                'unit'=>''                
            ),
            'regim'=>array (
                'denumire'=>'Regimul de funcționare',
                'valoare'=>'Continuu 100%',  
                'unit'=>''              
            ),
            'tip'=>array (
                'denumire'=>'Tipul constructiv',
                'valoare'=>'Asimetric, cu 3 coloane',   
                'unit'=>''             
            ),
            'racire'=>array (
                'denumire'=>'Sistemul de răcire',
                'valoare'=>'natural', 
                'unit'=>''               
            ),
            'izolatie'=>array (
                'denumire'=>'Clasa termică de izolație',
                'valoare'=>'F (115 C)',    
                'unit'=>''            
            ),
            'materialele'=>array (
                'denumire'=>'Materialele active',
                'valoare'=>'Cupru pentru înfășurări .
                    Tablă laminată la rece cu cristale orientate, miezul feromagnetic',
                    'unit'=>''                
                               
            )
          );

        return $detalii;
    }}
    public function tolerante($id)
    {
        $dateNominale = DateNominale::latest()->where('user_id',$id)->first();
        if($dateNominale==NULl){
            return $detalii = 'nu';
        }else{
            return $detalii = array (
                array (
                    'denumire'=>'Tensiunea secundară la mers în gol',
                    'valoare'=>'+/-0.5',
                    'unit'=>'%'
                ),
                array (
                    'denumire'=>'Tensiunea de scurtcircuit',
                    'valoare'=>$dateNominale->uscn,
                    'unit'=>'%'
                ),
                array (
                    'denumire'=>'Puterea la scurtcircuit nominal',
                    'valoare'=>'10',
                    'unit'=>'%'
                ),
                array (
                    'denumire'=>'Puterea la gol nominal',
                    'valoare'=>'+15',
                    'unit'=>'%'
                ),
                array (
                    'denumire'=>'Factorul de forma al transformatorului',
                    'valoare'=>$dateNominale->factorForma,
                    'unit'=>''
                )
            );
        }


        
    }
}
