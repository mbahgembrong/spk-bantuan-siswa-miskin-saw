<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePenilaianDetailRequest;
use App\Http\Requests\UpdatePenilaianDetailRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\PenilaianDetail;
use Illuminate\Http\Request;
use Flash;
use Response;

class PenilaianDetailController extends AppBaseController
{
    /**
     * Display a listing of the PenilaianDetail.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var PenilaianDetail $penilaianDetails */
        $penilaianDetails = PenilaianDetail::all();

        return view('penilaian_details.index')
            ->with('penilaianDetails', $penilaianDetails);
    }

    /**
     * Show the form for creating a new PenilaianDetail.
     *
     * @return Response
     */
    public function create()
    {
        return view('penilaian_details.create');
    }

    /**
     * Store a newly created PenilaianDetail in storage.
     *
     * @param CreatePenilaianDetailRequest $request
     *
     * @return Response
     */
    public function store(CreatePenilaianDetailRequest $request)
    {
        $input = $request->all();

        /** @var PenilaianDetail $penilaianDetail */
        $penilaianDetail = PenilaianDetail::create($input);

        Flash::success('Penilaian Detail saved successfully.');

        return redirect(route('penilaianDetails.index'));
    }

    /**
     * Display the specified PenilaianDetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PenilaianDetail $penilaianDetail */
        $penilaianDetail = PenilaianDetail::find($id);

        if (empty($penilaianDetail)) {
            Flash::error('Penilaian Detail not found');

            return redirect(route('penilaianDetails.index'));
        }

        return view('penilaian_details.show')->with('penilaianDetail', $penilaianDetail);
    }

    /**
     * Show the form for editing the specified PenilaianDetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var PenilaianDetail $penilaianDetail */
        $penilaianDetail = PenilaianDetail::find($id);

        if (empty($penilaianDetail)) {
            Flash::error('Penilaian Detail not found');

            return redirect(route('penilaianDetails.index'));
        }

        return view('penilaian_details.edit')->with('penilaianDetail', $penilaianDetail);
    }

    /**
     * Update the specified PenilaianDetail in storage.
     *
     * @param int $id
     * @param UpdatePenilaianDetailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePenilaianDetailRequest $request)
    {
        /** @var PenilaianDetail $penilaianDetail */
        $penilaianDetail = PenilaianDetail::find($id);

        if (empty($penilaianDetail)) {
            Flash::error('Penilaian Detail not found');

            return redirect(route('penilaianDetails.index'));
        }

        $penilaianDetail->fill($request->all());
        $penilaianDetail->save();

        Flash::success('Penilaian Detail updated successfully.');

        return redirect(route('penilaianDetails.index'));
    }

    /**
     * Remove the specified PenilaianDetail from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PenilaianDetail $penilaianDetail */
        $penilaianDetail = PenilaianDetail::find($id);

        if (empty($penilaianDetail)) {
            Flash::error('Penilaian Detail not found');

            return redirect(route('penilaianDetails.index'));
        }

        $penilaianDetail->delete();

        Flash::success('Penilaian Detail deleted successfully.');

        return redirect(route('penilaianDetails.index'));
    }
}
