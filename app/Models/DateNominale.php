<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateNominale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sn',
        'f',
        'u1n',
        'u2n',
        'conexiune',
        'uscn',
        'pscn'

    ];
}
