<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredimensionareColoana extends Model
{
    use HasFactory;

    protected $fillable = [
        'nominales_id',
        'sc_VA',
        'usca',
        'uscr',
        'km',
        'al_cm',
        'sum_ajai_cm',
        'BC',
        'D_m',
        'AC_mp'
    ];
}
