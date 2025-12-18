<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LaporanService;
class LaporanController extends Controller
{
    public function __construct(
        protected \LaporanService $laporanService
    ) {}

    public function generate(Request $request)
    {
        $this->laporanService->generate(
            $request->awal,
            $request->akhir
        );

        return back()->with('success', 'Laporan berhasil dibuat');
    }
}
