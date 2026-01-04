<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanLog extends Model
{
    protected $fillable = [
        'user_id',
        'format',
        'periode_awal',
        'periode_akhir',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
