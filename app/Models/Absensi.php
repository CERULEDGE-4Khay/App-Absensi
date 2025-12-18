<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = [
        'magang_id','tanggal','jam_masuk',
        'jam_keluar','lokasi','status','id'
    ];

    public function magang()
    {
        return $this->belongsTo(Magang::class);
    }
}
