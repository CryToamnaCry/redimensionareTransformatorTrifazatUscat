<?php

namespace App\Models\joasaTensiune;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimensionareInfasurareJT extends Model
{
    use HasFactory;

    protected $fillable = [
        'nominales_id',
        'Dmj_mm' ,
        'Lmed_m',
        'Rjt_ohm',
        'PjT_W',
        'aj_mm',
        'qjT_Wperm2',
        'spireStrat',
        'nrStraturi',
        'HBj_m'

    ];
}
