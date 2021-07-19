<?php

namespace App\Models\joasaTensiune;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredeterminareSectiuneConductorJT extends Model
{
    use HasFactory;

    protected $fillable = [
        'nominale_id',
        'PjT_W',        
        'RjT_ohm',
        'Dmj_mm',
        'Lmed_mm',
        'scond_mm2',
        'dc_calc_mm',
        'aj_mm'

    ];
}
