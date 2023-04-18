<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePenilaianRequest;
use App\Http\Requests\UpdatePenilaianRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Flash;
use Response;

class PenilaianController extends AppBaseController
{
    /**
     * Display a listing of the Penilaian.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Penilaian $penilaians */
        $penilaians = Penilaian::all();

        return view('penilaians.index')
            ->with('penilaians', $penilaians);
    }

    /**
     * Show the form for creating a new Penilaian.
     *
     * @return Response
     */
    public function create()
    {
        return view('penilaians.create');
    }

    /**
     * Store a newly created Penilaian in storage.
     *
     * @param CreatePenilaianRequest $request
     *
     * @return Response
     */
    public function store(CreatePenilaianRequest $request)
    {
        $input = $request->all();

        /** @var Penilaian $penilaian */
        $penilaian = Penilaian::create($input);

        Flash::success('Penilaian saved successfully.');

        return redirect(route('penilaians.index'));
    }

    /**
     * Display the specified Penilaian.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Penilaian $penilaian */
        $penilaian = Penilaian::find($id);

        if (empty($penilaian)) {
            Flash::error('Penilaian not found');

            return redirect(route('penilaians.index'));
        }

        return view('penilaians.show')->with('penilaian', $penilaian);
    }

    /**
     * Show the form for editing the specified Penilaian.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Penilaian $penilaian */
        $penilaian = Penilaian::find($id);

        if (empty($penilaian)) {
            Flash::error('Penilaian not found');

            return redirect(route('penilaians.index'));
        }

        return view('penilaians.edit')->with('penilaian', $penilaian);
    }

    /**
     * Update the specified Penilaian in storage.
     *
     * @param int $id
     * @param UpdatePenilaianRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePenilaianRequest $request)
    {
        /** @var Penilaian $penilaian */
        $penilaian = Penilaian::find($id);

        if (empty($penilaian)) {
            Flash::error('Penilaian not found');

            return redirect(route('penilaians.index'));
        }

        $penilaian->fill($request->all());
        $penilaian->save();

        Flash::success('Penilaian updated successfully.');

        return redirect(route('penilaians.index'));
    }

    /**
     * Remove the specified Penilaian from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Penilaian $penilaian */
        $penilaian = Penilaian::find($id);

        if (empty($penilaian)) {
            Flash::error('Penilaian not found');

            return redirect(route('penilaians.index'));
        }

        $penilaian->delete();

        Flash::success('Penilaian deleted successfully.');

        return redirect(route('penilaians.index'));
    }
}
