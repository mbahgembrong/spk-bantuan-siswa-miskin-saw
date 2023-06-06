<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKriteriadetailRequest;
use App\Http\Requests\UpdateKriteriadetailRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Kriteria;
use App\Models\Kriteriadetail;
use Illuminate\Http\Request;
use Flash;
use Response;

class KriteriadetailController extends AppBaseController
{
    /**
     * Display a listing of the Kriteriadetail.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request, $kriteriaId)
    {
        $kriteria = Kriteria::find($kriteriaId);
        /** @var Kriteriadetail $kriteriadetails */
        $kriteriadetails = Kriteriadetail::where('kriteria_id', $kriteriaId)->get();

        return view('kriteriadetails.index', compact('kriteria'))
            ->with('kriteriadetails', $kriteriadetails);
    }

    /**
     * Show the form for creating a new Kriteriadetail.
     *
     * @return Response
     */
    public function create($kriteriaId)
    {
        $kriteria = Kriteria::find($kriteriaId);
        return view('kriteriadetails.create', compact('kriteria'));
    }

    /**
     * Store a newly created Kriteriadetail in storage.
     *
     * @param CreateKriteriadetailRequest $request
     *
     * @return Response
     */
    public function store(CreateKriteriadetailRequest $request, $kriteriaId)
    {
        $input = $request->all();
        if ($request->has('range_awal')) {
            if ($request->range_akhir == "500.000") {
                $input['nama'] = "X < Rp. 500.000,-";
            } else if ($request->range_awal == "2.000.000")
                $input['nama'] = "X > Rp. 2.000.000,-";
            else
                $input['nama'] = "Rp. " . $request->range_awal . ",- < X < Rp. " . $request->range_akhir . ",-";
        }

        /** @var Kriteriadetail $kriteriadetail */
        $kriteriadetail = Kriteriadetail::create($input);

        Flash::success('Kriteriadetail saved successfully.');

        return redirect(route('kriteriadetails.index', $kriteriaId));
    }

    /**
     * Display the specified Kriteriadetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($kriteriaId, $id)
    {
        $kriteria = Kriteria::find($kriteriaId);
        /** @var Kriteriadetail $kriteriadetail */
        $kriteriadetail = Kriteriadetail::find($id);

        if (empty($kriteriadetail)) {
            Flash::error('Kriteriadetail not found');

            return redirect(route('kriteriadetails.index', $kriteriaId));
        }

        return view('kriteriadetails.show', compact('kriteria'))->with('kriteriadetail', $kriteriadetail);
    }

    /**
     * Show the form for editing the specified Kriteriadetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($kriteriaId, $id)
    {
        $kriteria = Kriteria::find($kriteriaId);
        /** @var Kriteriadetail $kriteriadetail */
        $kriteriadetail = Kriteriadetail::find($id);
        $range = [];
        if ($kriteria->kode == 'penghasilan') {
            $explode = explode('X', $kriteriadetail->nama);
            $rangeAwal = rtrim(substr($explode[0], 4), ',- <') ?: rtrim(substr($explode[1], 7), ',-');
            $rangeAkhir = rtrim(substr($explode[1], 7), ',-') ?: rtrim(substr($explode[0], 7), ',-');
            $range['rangeAwal'] = $rangeAwal;
            $range['rangeAkhir'] = $rangeAkhir;

        }

        if (empty($kriteriadetail)) {
            Flash::error('Kriteriadetail not found');

            return redirect(route('kriteriadetails.index', $kriteriaId));
        }

        return view('kriteriadetails.edit', compact(['kriteria', 'range']))->with('kriteriadetail', $kriteriadetail);
    }

    /**
     * Update the specified Kriteriadetail in storage.
     *
     * @param int $id
     * @param UpdateKriteriadetailRequest $request
     *
     * @return Response
     */
    public function update($kriteriaId, $id, UpdateKriteriadetailRequest $request)
    {
        /** @var Kriteriadetail $kriteriadetail */
        $kriteriadetail = Kriteriadetail::find($id);

        if (empty($kriteriadetail)) {
            Flash::error('Kriteriadetail not found');

            return redirect(route('kriteriadetails.index', $kriteriaId));
        }
        $input = $request->all();
        if ($request->nama == 'penghasilan') {
            if ($request->range_akhir == "500.000") {
                $input['nama'] = "X < Rp. 500.000,-";
            } else if ($request->range_awal == "2.000.000")
                $input['nama'] = "X > Rp. 2.000.000,-";
            else
                $input['nama'] = "Rp. " . $request->range_awal . ",- < X < Rp. " . $request->range_akhir . ",-";

        }

        $kriteriadetail->fill($input);
        $kriteriadetail->save();

        Flash::success('Kriteriadetail updated successfully.');

        return redirect(route('kriteriadetails.index', $kriteriaId));
    }

    /**
     * Remove the specified Kriteriadetail from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($kriteriaId, $id)
    {
        /** @var Kriteriadetail $kriteriadetail */
        $kriteriadetail = Kriteriadetail::find($id);

        if (empty($kriteriadetail)) {
            Flash::error('Kriteriadetail not found');

            return redirect(route('kriteriadetails.index', $kriteriaId));
        }

        $kriteriadetail->delete();

        Flash::success('Kriteriadetail deleted successfully.');

        return redirect(route('kriteriadetails.index', $kriteriaId));
    }
}