<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Kriteria;
use App\Models\Kriteriadetail;
use App\Models\Siswa;
use App\Models\SiswaDetail;
use App\Models\SubSiswaDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Response;

class SiswaController extends AppBaseController
{
    /**
     * Display a listing of the Siswa.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Siswa $siswas */
        $siswas = Siswa::all();

        return view('siswas.index')
            ->with('siswas', $siswas);
    }

    /**
     * Show the form for creating a new Siswa.
     *
     * @return Response
     */
    public function create()
    {
        $kriterias = Kriteria::all();
        return view('siswas.create', compact('kriterias'));
    }

    /**
     * Store a newly created Siswa in storage.
     *
     * @param CreateSiswaRequest $request
     *
     * @return Response
     */
    public function store(CreateSiswaRequest $request)
    {
        $input = $request->all();
        $input['tanggal_lahir'] = Carbon::createFromFormat('d/m/Y', $input['tanggal_lahir'])->format('Y-m-d');
        // dd($input);
        $kriteriaSingle = [];
        $kriteriaMultiple = [];
        foreach ($input as $key => $value) {
            if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-5][0-9a-f]{3}-[089ab][0-9a-f]{3}-[0-9a-f]{12}$/', $key)) {
                $kriteriaSingle[$key] = $value;
            } else if (preg_match('/^[A-Za-z]+_[0-9a-f]{8}-[0-9a-f]{4}-[0-5][0-9a-f]{3}-[089ab][0-9a-f]{3}-[0-9a-f]{12}$/', $key)) {
                $kriteriaMultiple[$key] = $value;
            }
        }
        /** @var Siswa $siswa */
        $siswa = Siswa::create($input);
        foreach ($kriteriaSingle as $key => $value) {
            $kriteria = Kriteriadetail::find($value);
            SiswaDetail::create([
                'siswa_id' => $siswa->id,
                'kriteria_id' => $key,
                'kriteria_detail_id' => $value,
                'bobot' => $kriteria->bobot,
                'keterangan' => $kriteria->nama
            ]);
        }
        foreach ($kriteriaMultiple as $key => $value) {
            if (preg_match('/^bobot+_[0-9a-f]{8}-[0-9a-f]{4}-[0-5][0-9a-f]{3}-[089ab][0-9a-f]{3}-[0-9a-f]{12}$/', $key)) {
                $kriteriaId = str_replace('bobot_', '', $key);
                $siswaDetail = SiswaDetail::create([
                    'siswa_id' => $siswa->id,
                    'kriteria_id' => $kriteriaId
                ]);
                $bobot = 0;
                $countSubSiswaDetail = count($kriteriaMultiple[$key]);
                foreach ($kriteriaMultiple['bobot_' . $kriteriaId] as $key => $value) {
                    $kriteria = Kriteriadetail::find($value);
                    SubSiswaDetail::create([
                        'siswa_detail_id' => $siswaDetail->id,
                        'kriteria_id' => $kriteriaId,
                        'kriteria_detail_id' => $value,
                        'bobot' => $kriteria->bobot,
                        'keterangan' => $kriteriaMultiple['keterangan_' . $kriteriaId][$key]
                    ]);
                    $bobot += $kriteria->bobot;
                }
                $siswaDetail->bobot = $bobot / $countSubSiswaDetail;
                $siswaDetail->save();
            }
        }
        // dd($input);
        Flash::success('Siswa saved successfully.');

        return redirect(route('siswas.index'));
    }

    /**
     * Display the specified Siswa.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Siswa $siswa */
        $siswa = Siswa::find($id);

        if (empty($siswa)) {
            Flash::error('Siswa not found');

            return redirect(route('siswas.index'));
        }

        return view('siswas.show')->with('siswa', $siswa);
    }

    /**
     * Show the form for editing the specified Siswa.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Siswa $siswa */
        $siswa = Siswa::find($id);

        if (empty($siswa)) {
            Flash::error('Siswa not found');

            return redirect(route('siswas.index'));
        }
        $kriterias = Kriteria::all();
        return view('siswas.edit', compact('kriterias'))->with('siswa', $siswa);
    }

    /**
     * Update the specified Siswa in storage.
     *
     * @param int $id
     * @param UpdateSiswaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSiswaRequest $request)
    {
        /** @var Siswa $siswa */
        $siswa = Siswa::find($id);

        if (empty($siswa)) {
            Flash::error('Siswa not found');

            return redirect(route('siswas.index'));
        }

        $input = $request->all();
        $input['tanggal_lahir'] = Carbon::createFromFormat('d/m/Y', $input['tanggal_lahir'])->format('Y-m-d');

        $kriteriaSingle = [];
        $kriteriaMultiple = [];
        foreach ($input as $key => $value) {
            if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-5][0-9a-f]{3}-[089ab][0-9a-f]{3}-[0-9a-f]{12}$/', $key)) {
                $kriteriaSingle[$key] = $value;
            } else if (preg_match('/^[A-Za-z]+_[0-9a-f]{8}-[0-9a-f]{4}-[0-5][0-9a-f]{3}-[089ab][0-9a-f]{3}-[0-9a-f]{12}$/', $key)) {
                $kriteriaMultiple[$key] = $value;
            }
        }

        $siswa->fill($input);
        $siswa->save();
        $siswa->siswaDetail()->each(
            function ($siswaDetail) {
                if ($siswaDetail->kriteria_detail_id == null)
                    $siswaDetail->subSiswaDetail()->each(function ($subSiswaDetail) {
                        $subSiswaDetail->delete();
                    });
                $siswaDetail->delete();
            }
        );
        foreach ($kriteriaSingle as $key => $value) {
            $kriteria = Kriteriadetail::find($value);
            SiswaDetail::create([
                'siswa_id' => $siswa->id,
                'kriteria_id' => $key,
                'kriteria_detail_id' => $value,
                'bobot' => $kriteria->bobot,
                'keterangan' => $kriteria->nama
            ]);
        }
        foreach ($kriteriaMultiple as $key => $value) {
            if (preg_match('/^bobot+_[0-9a-f]{8}-[0-9a-f]{4}-[0-5][0-9a-f]{3}-[089ab][0-9a-f]{3}-[0-9a-f]{12}$/', $key)) {
                $kriteriaId = str_replace('bobot_', '', $key);
                $siswaDetail = SiswaDetail::create([
                    'siswa_id' => $siswa->id,
                    'kriteria_id' => $kriteriaId
                ]);
                $bobot = 0;
                $countSubSiswaDetail = count($kriteriaMultiple[$key]);
                foreach ($kriteriaMultiple['bobot_' . $kriteriaId] as $key => $value) {
                    $kriteria = Kriteriadetail::find($value);
                    SubSiswaDetail::create([
                        'siswa_detail_id' => $siswaDetail->id,
                        'kriteria_id' => $kriteriaId,
                        'kriteria_detail_id' => $value,
                        'bobot' => $kriteria->bobot,
                        'keterangan' => $kriteriaMultiple['keterangan_' . $kriteriaId][$key]
                    ]);
                    $bobot += $kriteria->bobot;
                }
                $siswaDetail->bobot = $bobot / $countSubSiswaDetail;
                $siswaDetail->save();
            }
        }
        // dd($input);
        Flash::success('Siswa updated successfully.');

        return redirect(route('siswas.index'));
    }

    /**
     * Remove the specified Siswa from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Siswa $siswa */
        $siswa = Siswa::find($id);

        if (empty($siswa)) {
            Flash::error('Siswa not found');

            return redirect(route('siswas.index'));
        }

        $siswa->delete();

        Flash::success('Siswa deleted successfully.');

        return redirect(route('siswas.index'));
    }
}
