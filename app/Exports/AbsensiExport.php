<?php

namespace App\Exports;

use App\Models\Magang;
use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $awal;
    protected $akhir;

    public function __construct($awal, $akhir)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
    }

    public function collection()
    {
        // Mengambil data Magang yang aktif/pernah ada di periode tersebut
        // dan menghitung statistik kehadirannya
        return Magang::with('user')
            ->whereHas('absensi', function($q) {
                $q->whereBetween('tanggal', [$this->awal, $this->akhir]);
            })->get();
    }

    public function headings(): array
    {
        return [
            ['LAPORAN REKAPITULASI KEHADIRAN MAGANG'],
            ['Periode: ' . $this->awal . ' s/d ' . $this->akhir],
            [''], // Baris kosong
            [
                'No',
                'Nama Peserta',
                'Asal Instansi',
                'Total Hadir',
                'Total Terlambat',
                'Persentase Kehadiran',
                'Status Peserta'
            ]
        ];
    }

    public function map($magang): array
    {
        static $no = 1;

        // Hitung statistik per user dalam periode tersebut
        $totalHadir = Absensi::where('magang_id', $magang->id)
            ->whereBetween('tanggal', [$this->awal, $this->akhir])
            ->where('status', 'Hadir')
            ->count();

        // Contoh hitung terlambat (asumsi jam masuk > 08:00)
        $totalTerlambat = Absensi::where('magang_id', $magang->id)
            ->whereBetween('tanggal', [$this->awal, $this->akhir])
            ->whereTime('jam_masuk', '>', '08:00:00')
            ->count();

        // Hitung total hari kerja (senin-jumat) di periode tersebut untuk persentase
        $start = \Carbon\Carbon::parse($this->awal);
        $end = \Carbon\Carbon::parse($this->akhir);
        $totalHariKerja = $start->diffInDaysFiltered(function($date) {
            return !$date->isWeekend();
        }, $end) + 1;

        $persentase = ($totalHadir / $totalHariKerja) * 100;

        return [
            $no++,
            $magang->user->name,
            $magang->asal_instansi,
            $totalHadir . ' Hari',
            $totalTerlambat . ' Kali',
            round($persentase) . '%',
            strtoupper($magang->status)
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style Header Judul
            1    => ['font' => ['bold' => true, 'size' => 14]],
            2    => ['font' => ['italic' => true]],
            // Style Header Tabel
            4    => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '0D9488'] // Warna Teal (sesuai tema kamu)
                ]
            ],
            // Border untuk seluruh data
            'A4:G' . ($sheet->getHighestRow()) => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],
        ];
    }
}