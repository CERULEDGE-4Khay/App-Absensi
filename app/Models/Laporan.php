<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'periode_awal','periode_akhir',
        'total_hadir','tanggal_generate'
    ];
}
