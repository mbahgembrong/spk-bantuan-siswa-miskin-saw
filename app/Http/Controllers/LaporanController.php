<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\Kriteria;
use App\Models\Siswa;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function prestasi(Request $request)
    {
        $siswas = Siswa::all();
        $kriteriaId = Kriteria::where('kode', 'prestasi')->first()->id;
        return view('laporan.prestasi', compact(['siswas', 'kriteriaId']));
    }
    public function nilai(Request $request)
    {
        $siswas = Siswa::all();
        $kriteriaId = Kriteria::where('kode', 'nilai')->first()->id;
        return view('laporan.nilai', compact(['siswas', 'kriteriaId']));
    }
    public function bantuan(Request $request)
    {
        $bantuans = Bantuan::all();
        return view('laporan.bantuan', compact('bantuans'));
    }
}
