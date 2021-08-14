<?php

namespace App\Models\inaltaTensiune;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimensionareIT extends Model
{
    use HasFactory;

    protected $fillable = [
        'nominale_id',
        'ai_mm',
        'RiT_ohm',
        'Dmi_mm',
        'Lmed_mm',
        'PiT_W',
        'qiT_Wperm2',
        'HBi_m',
        'wi',
        'E',
        'wiTotal',
        'nrSpire',
        'nrStraturi',
        'msg',
        'dci_Mm'
    ];
}
