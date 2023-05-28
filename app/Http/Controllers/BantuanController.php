<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Http\Requests\CreateBantuanRequest;
use App\Http\Requests\UpdateBantuanRequest;
use App\Models\Kriteria;
use App\Models\Siswa;
use App\Models\SiswaBantuan;
use Illuminate\Support\Facades\Request;
use Laracasts\Flash\Flash;

class BantuanController extends Controller
{
    /**
     * Display a listing of the Bantuan.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Bantuan $bantuans */
        $bantuans = Bantuan::all();

        return view('bantuans.index')
            ->with('bantuans', $bantuans);
    }

    /**
     * Show the form for creating a new Bantuan.
     *
     * @return Response
     */
    public function create()
    {
        return view('bantuans.create');
    }

    /**
     * Store a newly created Bantuan in storage.
     *
     * @param CreateBantuanRequest $request
     *
     * @return Response
     */
    public function store(CreateBantuanRequest $request)
    {
        $input = $request->all();

        /** @var Bantuan $bantuan */
        $bantuan = Bantuan::create($input);

        Flash::success('Bantuan saved successfully.');

        return redirect(route('bantuans.index'));
    }

    private function prosesSAW($bantuan)
    {
        try {
            $vectorBobot = Kriteria::all();
            $nilaiFuzzy = [];
            $nilaiRumusKriteria = ['benefit' => [], 'cost' => []];
            if ($bantuan->ganda) {
                $siswas = Siswa::all();
            } else {
                $siswas = Siswa::whereNotIn('id', function ($q) {
                    $q->select('siswa_id')->from('siswa_bantuans');
                })->get();
            }
            // nilai fuzzy
            foreach ($siswas as $siswa) {
                $nilaiFuzzy[$siswa->id] = ['siswa_id' => $siswa->id, 'siswa_nama' => $siswa->nama, 'fuzzy' => $siswa->getNilaiFuzzy(), 'bobot' => ['benefit' => [], 'cost' => []], 'total_nilai' => 0];
            }

            // nilaiRumusKriteria
            foreach ($vectorBobot as $vector) {
                $tempArrayPenilaian = [];
                foreach ($nilaiFuzzy as $siswaId => $siswa) {
                    foreach ($siswa['fuzzy'] as $key => $value) {
                        if ($key == $vector->id) {
                            if ($vector->jenis == 'benefit')
                                array_push($nilaiFuzzy[$siswaId]['bobot']['benefit'], ['vector_id' => $key, 'bobot' => ($value / 100), 'penilaian' => 0, 'jenis_penilaian' => '', 'nilai_normalisasi' => 0, 'nilai_akhir' => 0, 'bobot_kriteria' => $vector->bobot / 100]);
                            if ($vector->jenis == 'cost')
                                array_push($nilaiFuzzy[$siswaId]['bobot']['cost'], ['vector_id' => $key, 'bobot' => ($value / 100), 'penilaian' => 0, 'jenis_penilaian' => '', 'nilai_normalisasi' => 0, 'nilai_akhir' => 0, 'bobot_kriteria' => $vector->bobot / 100]);
                            array_push($tempArrayPenilaian, ($value / 100));
                        }
                    }
                }
                $penilaian = 0;
                
                if ($vector->jenis == 'benefit') {
                    try {
                        $penilaian = max($tempArrayPenilaian);
                    } catch (\Throwable $th) {
                        $penilaian=0;
                    }
                    $nilaiRumusKriteria['benefit'][$vector->id] = ['vector_nama' => $vector->nama, 'penilaian' => $penilaian, 'jenis_penilaian' => 'max', 'bobot' => $vector->bobot];
                }
                if ($vector->jenis == 'cost') {
                    try {
                        $penilaian = min($tempArrayPenilaian) ;
                    } catch (\Throwable $th) {
                        $penilaian=0;
                    }
                    $nilaiRumusKriteria['cost'][$vector->id] = ['vector_nama' => $vector->nama, 'penilaian' => $penilaian, 'jenis_penilaian' => 'min', 'bobot' => $vector->bobot];
                }
            }
            foreach ($nilaiFuzzy as $siswaId => $siswa) {
                $tempNilaiAkhir = [];
                foreach ($siswa['bobot'] as $jenisVector => $item) {
                    foreach ($item as $indexDetailSiswa => $detailSiswa) {
                        foreach ($nilaiRumusKriteria as $kriteria) {
                            foreach ($kriteria as $kriteriaId => $kriteria) {
                                if ($detailSiswa['vector_id'] == $kriteriaId) {
                                    if ($jenisVector == 'benefit') {
                                        // nilai normalisassi
                                        $nilaiFuzzy[$siswaId]['bobot']['benefit'][$indexDetailSiswa]['jenis_penilaian'] = $kriteria['jenis_penilaian'];
                                        $nilaiFuzzy[$siswaId]['bobot']['benefit'][$indexDetailSiswa]['penilaian'] = $kriteria['penilaian'];
                                        $nilaiFuzzy[$siswaId]['bobot']['benefit'][$indexDetailSiswa]['nilai_normalisasi'] = $detailSiswa['bobot'] / $kriteria['penilaian'];
                                        // nilai akhir
                                        $nilaiFuzzy[$siswaId]['bobot']['benefit'][$indexDetailSiswa]['nilai_akhir'] = $nilaiFuzzy[$siswaId]
                                        ['bobot']['benefit'][$indexDetailSiswa]['bobot_kriteria'] * $nilaiFuzzy[$siswaId]['bobot']['benefit'][$indexDetailSiswa]['nilai_normalisasi'];
                                        array_push($tempNilaiAkhir, $nilaiFuzzy[$siswaId]['bobot']['benefit'][$indexDetailSiswa]['nilai_akhir']);
                                    }
                                    if ($jenisVector == 'cost') {
                                        // nilai normalisasi
                                        $nilaiFuzzy[$siswaId]['bobot']['cost'][$indexDetailSiswa]['jenis_penilaian'] = $kriteria['jenis_penilaian'];
                                        $nilaiFuzzy[$siswaId]['bobot']['cost'][$indexDetailSiswa]['penilaian'] = $kriteria['penilaian'];
                                        $nilaiFuzzy[$siswaId]['bobot']['cost'][$indexDetailSiswa]['nilai_normalisasi'] = $kriteria['penilaian'] / $detailSiswa['bobot'];
                                        // nilai akhir
                                        $nilaiFuzzy[$siswaId]['bobot']['cost'][$indexDetailSiswa]['nilai_akhir'] = $nilaiFuzzy[$siswaId]['bobot']['cost'][$indexDetailSiswa]['bobot_kriteria'] * $nilaiFuzzy[$siswaId]['bobot']['cost'][$indexDetailSiswa]['nilai_normalisasi'];
                                        array_push($tempNilaiAkhir, $nilaiFuzzy[$siswaId]['bobot']['cost'][$indexDetailSiswa]['nilai_akhir']);
                                    }
                                }
                            }

                        }
                    }
                }
                $nilaiFuzzy[$siswaId]['total_nilai'] = array_sum($tempNilaiAkhir);
            }
            return compact(['vectorBobot', 'nilaiFuzzy', 'nilaiRumusKriteria', 'bantuan']);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function proses(Request $request, $id)
    {
        $bantuan = Bantuan::find($id);

        if (empty($bantuan)) {
            Flash::error('Bantuan not found');

            return redirect(route('bantuans.index'));
        }
        $prosesSaw = $this->prosesSAW($bantuan);
        $vectorBobot = $prosesSaw['vectorBobot'];
        $nilaiFuzzy = $prosesSaw['nilaiFuzzy'];
        $nilaiRumusKriteria = $prosesSaw['nilaiRumusKriteria'];

        return view('bantuans.proses', compact(['vectorBobot', 'nilaiFuzzy', 'nilaiRumusKriteria', 'bantuan']));
    }
    public function prosesSelesai(Request $request, $id)
    {
        $bantuan = Bantuan::find($id);

        if (empty($bantuan)) {
            Flash::error('Bantuan not found');

            return redirect(route('bantuans.index'));
        }
        $bantuan->status = 'selesai';
        $bantuan->save();
        $prosesSaw = $this->prosesSAW($bantuan);
        $vectorBobot = $prosesSaw['vectorBobot'];
        $nilaiFuzzy = $prosesSaw['nilaiFuzzy'];
        $nilaiRumusKriteria = $prosesSaw['nilaiRumusKriteria'];
        usort($nilaiFuzzy, function ($a, $b) {
            return $b['total_nilai'] <=> $a['total_nilai'];
        });
        foreach ($nilaiFuzzy as $key => $value) {
            if ($key + 1 <= $bantuan->kuota) {
                $nilaiFuzzy[$key]['menerima_bantuan'] = true;
            } else {
                $nilaiFuzzy[$key]['menerima_bantuan'] = false;
            }
        }
        foreach ($nilaiFuzzy as $value) {
            if ($value['menerima_bantuan']) {
                $bantuanSiswa = new SiswaBantuan();
                $bantuanSiswa->bantuan_id = $bantuan->id;
                $bantuanSiswa->siswa_id = $value['siswa_id'];
                $bantuanSiswa->bantuan = $value['menerima_bantuan'];
                $bantuanSiswa->bobot = $value['total_nilai'];
                $bantuanSiswa->save();
            } else
                break;
        }
        return redirect()->route('bantuans.index');
    }
    /**
     * Display the specified Bantuan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Bantuan $bantuan */
        $bantuan = Bantuan::find($id);

        if (empty($bantuan)) {
            Flash::error('Bantuan not found');

            return redirect(route('bantuans.index'));
        }

        return view('bantuans.show')->with('bantuan', $bantuan);
    }


    /**
     * Show the form for editing the specified Bantuan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Bantuan $bantuan */
        $bantuan = Bantuan::find($id);

        if (empty($bantuan)) {
            Flash::error('Bantuan not found');

            return redirect(route('bantuans.index'));
        }

        return view('bantuans.edit')->with('bantuan', $bantuan);
    }

    /**
     * Update the specified Bantuan in storage.
     *
     * @param int $id
     * @param UpdateBantuanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBantuanRequest $request)
    {
        /** @var Bantuan $bantuan */
        $bantuan = Bantuan::find($id);

        if (empty($bantuan)) {
            Flash::error('Bantuan not found');

            return redirect(route('bantuans.index'));
        }

        $bantuan->fill($request->all());
        $bantuan->save();

        Flash::success('Bantuan updated successfully.');

        return redirect(route('bantuans.index'));
    }

    /**
     * Remove the specified Bantuan from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Bantuan $bantuan */
        $bantuan = Bantuan::find($id);

        if (empty($bantuan)) {
            Flash::error('Bantuan not found');

            return redirect(route('bantuans.index'));
        }

        $bantuan->delete();

        Flash::success('Bantuan deleted successfully.');

        return redirect(route('bantuans.index'));
    }
}