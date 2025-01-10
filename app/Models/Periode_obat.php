<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode_obat extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_periode',
        'id_obat',
        'jumlah'
    ];
}
