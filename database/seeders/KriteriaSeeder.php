<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kriteria::create([
            'nama' => 'Kepemilikan Kartu KIS',
            'bobot' => '25',
            'kode' => 'kis',
            'jenis' => 'benefit',
            'tipe' => 'single'
        ]);
        Kriteria::create([
            'nama' => 'Penghasilan Orang Tua',
            'bobot' => '20',
            'kode' => 'penghasilan',
            'jenis' => 'cost',
            'tipe' => 'single'
        ]);
        Kriteria::create([
            'nama' => 'Kepemilikan Kendaraan',
            'bobot' => '20',
            'kode' => 'kendaraan',
            'jenis' => 'cost',
            'tipe' => 'single'
        ]);
        Kriteria::create([
            'nama' => 'Prestasi',
            'bobot' => '10',
            'kode' => 'prestasi',
            'jenis' => 'benefit',
            'tipe' => 'multiple'
        ]);
        Kriteria::create([
            'nama' => 'Rata Nilai',
            'bobot' => '5',
            'kode' => 'nilai',
            'jenis' => 'benefit',
            'tipe' => 'multiple'
        ]);
        Kriteria::create([
            'nama' => 'Kondisi Rumah',
            'bobot' => '10',
            'kode' => 'rumah',
            'jenis' => 'benefit',
            'tipe' => 'single'
        ]);
        Kriteria::create([
            'nama' => 'Tanggungan Orang Tua',
            'bobot' => '10',
            'kode' => 'tanggungan',
            'jenis' => 'benefit',
            'tipe' => 'single'
        ]);
    }
}
