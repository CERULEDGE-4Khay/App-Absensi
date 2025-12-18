<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    protected $fillable = [
        'user_id','nama','asal_instansi','tanggal_mulai','tanggal_selesai','status','latitude','longitude'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
