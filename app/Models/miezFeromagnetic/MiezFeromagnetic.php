<?php

namespace App\Models\miezFeromagnetic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiezFeromagnetic extends Model
{
    use HasFactory;

    protected $fillable = [
        'nominale_id',
        'TrepteColoana_a_mm',
        'TrepteJug_b_mm',
        'Bc_T',
        'Bjug_T',
        'H_mm',
        'L_mm',
        'Mcol_kg',
        'Mjug_kg'

    ];
}
