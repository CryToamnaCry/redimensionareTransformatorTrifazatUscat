<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredimensionareSpiraJT extends Model
{
    use HasFactory;

    protected $fillable = [
        'nominale_id',
        'wj_spire',
        'usp_V',
    ];
}
