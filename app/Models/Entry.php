<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'totalPemasukan',
        'hargaModal',
        'keuntungan',
        'status',
        'details',
        'description',
        'isPemasukan',
        'isOrder'
    ];

    protected $casts = [
        'details' => 'array'
    ];  
}
