<?php

namespace App\Http\Controllers;

use App\Services\AbsensiService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AbsensiController extends Controller
{
    public function __construct(
        protected \AbsensiService $service
    ) {}

    public function masuk(Request $request)
    {
        $this->service->absenMasuk(
            auth()->user()->magang->id,
            $request->lokasi
        );

        return back()->with('success','Absen masuk berhasil');
    }

    public function keluar()
    {
        $this->service->absenKeluar(
            auth()->user()->magang->id
        );

        return back()->with('success','Absen keluar berhasil');
    }
}
