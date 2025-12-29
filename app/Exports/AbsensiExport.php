<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AbsensiExport implements FromQuery, WithHeadings, WithMapping
{
    protected $awal;
    protected $akhir;

    public function __construct($awal, $akhir)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
    }

    public function query()
    {
        // Menggunakan query builder sesuai kebutuhan interface FromQuery
        return Absensi::query()
            ->with('magang.user')
            ->whereBetween('tanggal', [$this->awal, $this->akhir]);
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Peserta',
            'Instansi',
            'Jam Masuk',
            'Jam Keluar',
            'Status'
        ];
    }

    public function map($absensi): array
    {
        return [
            $absensi->tanggal,
            $absensi->magang->user->name ?? '-',
            $absensi->magang->asal_instansi ?? '-',
            $absensi->jam_masuk,
            $absensi->jam_keluar,
            $absensi->status,
        ];
    }
}