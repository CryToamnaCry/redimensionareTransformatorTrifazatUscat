<?php

namespace App\Models;

use App\Models\DateNominale;
use App\Models\MarimiDeFaza;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MarimiDeFaza extends Model
{
    use HasFactory;

    protected $fillable = [
        'nominale_id',
        'i1f',
        'i2f',
        'u1f',
        'u2f'
    ];
}
