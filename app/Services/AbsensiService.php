<?php

use App\Models\Absensi;
class AbsensiService
{
    public function absenMasuk($magangId, $lokasi)
    {
        return Absensi::create([
            'magang_id' => $magangId,
            'tanggal' => now()->toDateString(),
            'jam_masuk' => now()->toTimeString(),
            'lokasi' => $lokasi,
            'status' => 'Hadir'
        ]);
    }

    public function absenKeluar($magangId)
    {
        return Absensi::where('magang_id', $magangId)
            ->whereDate('tanggal', now())
            ->update([
                'jam_keluar' => now()->toTimeString()
            ]);
    }
}
