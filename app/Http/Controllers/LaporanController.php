<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LaporanService;
class LaporanController extends Controller
{
public function __construct(
        protected LaporanService $laporanService // Hapus tanda backslash (\)
    ) {}

    public function index()
    {
    return view('admin.laporan.index');
    }
    public function generate(Request $request)
{
    $request->validate([
        'awal' => 'required|date',
        'akhir' => 'required|date|after_or_equal:awal',
        'format' => 'required|in:excel,pdf'
    ]);

    // Berikan nama file di level Controller agar browser tidak bingung
    $namaFile = "rekap-absensi-" . $request->awal . "." . $request->format;

    return $this->laporanService->generate(
        $request->awal,
        $request->akhir,
        $request->format,
                $namaFile // Tambahkan parameter nama file ke service
    );
}
}
