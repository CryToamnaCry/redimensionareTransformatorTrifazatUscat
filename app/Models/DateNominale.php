<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateNominale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sn_VA',
        'f_Hz',
        'u1n_V',
        'u2n_V',
        'conexiune',
        'uscn',
        'pscn_W',
        'factorForma'

    ];
}
