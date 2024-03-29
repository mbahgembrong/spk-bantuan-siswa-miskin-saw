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
        $siswas = Siswa::orderBy('created_at', 'DESC')->get();

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
        $nis = Siswa::select('nis')->orderBy('created_at', 'DESC')->first();
        if (is_null($nis)) {
            $nis = date('Y') . '1';
        } else {
            if (date('Y') != substr($nis->nis, 0, 4))
                $nis = date('Y') . '1';
            else {
                $nis = date('Y') . ((int) substr($nis->nis, 4) + 1);
            }
        }
        $kriterias = Kriteria::all();
        return view('siswas.create', compact(['kriterias', 'nis']));
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

        if (is_null($request->nisn)) {
            $yearNisn = substr(Carbon::createFromFormat('d/m/Y', $request->tanggal_lahir)->format('Y'), 2);
            $digits = 4;
            $nisn = $yearNisn . $yearNisn . rand(pow(10, $digits - 1), pow(10, $digits) - 1) . rand(pow(10, $digits - 1), pow(10, $digits) - 1);
            $input['nisn'] = $nisn;
        }

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $name = time() . '.' . $foto->getClientOriginalName();
            $destinationPath = public_path('/storage/siswas/foto');
            $foto->move($destinationPath, $name);
            $input['foto'] = $name;
        } else {
            unset($input['foto']);
        }
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
                'keterangan' => $kriteria->nama,
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
                        'bobot' => $kriteria->bobot ?? 0,
                        'keterangan' => $kriteriaMultiple['keterangan_' . $kriteriaId][$key],
                        'nilai' => $kriteriaMultiple['nilai_' . $kriteriaId][$key] ?? null,
                    ]);
                    $bobot += $kriteria->bobot ?? 0;
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

        if (is_null($request->nisn)) {
            $yearNisn = substr(Carbon::createFromFormat('d/m/Y', $request->tanggal_lahir)->format('Y'), 2);
            $digits = 4;
            $nisn = $yearNisn . $yearNisn . rand(pow(10, $digits - 1), pow(10, $digits) - 1) . rand(pow(10, $digits - 1), pow(10, $digits) - 1);
            $input['nisn'] = $nisn;
        }
        if ($request->hasFile('foto') && $request->file('foto')->getClientOriginalName() != $siswa->foto) {
            $foto = $request->file('foto');
            $name = time() . '.' . $foto->getClientOriginalName();
            $destinationPath = public_path('/storage/siswas/foto');
            $foto->move($destinationPath, $name);
            $input['foto'] = $name;
        } else
            unset($input['foto']);

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
                'bobot' => $kriteria->bobot ?? 0,
                'keterangan' => $kriteria->nama,
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
                        'bobot' => $kriteria->bobot ?? 0,
                        'keterangan' => $kriteriaMultiple['keterangan_' . $kriteriaId][$key],
                        'nilai' => $kriteriaMultiple['nilai_' . $kriteriaId][$key] ?? null,
                    ]);
                    $bobot += $kriteria->bobot ?? 0;
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