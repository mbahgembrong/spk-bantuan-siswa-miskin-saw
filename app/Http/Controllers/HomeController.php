<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\Kriteria;
use App\Models\Siswa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $count = [];
        $count['kriteria'] = Kriteria::count();
        $count['siswa'] = Siswa::count();
        $count['bantuan_proses'] = Bantuan::where('status', 'proses')->count();
        $count['bantuan_selesai'] = Bantuan::where('status', 'selesai')->count();
        return view('home', compact('count'));
    }
}
