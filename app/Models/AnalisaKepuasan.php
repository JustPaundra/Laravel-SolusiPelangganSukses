<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisaKepuasan extends Model
{
    use HasFactory;

    protected $table = 'analisa_kepuasan';
    
    protected $primaryKey = 'id_tiket';

    protected $fillable = [
        'pemesan',
        'sektor',
        'skor_kepuasan',
        'skor_customer_effort',
        'foto_bukti',
    ];
}

