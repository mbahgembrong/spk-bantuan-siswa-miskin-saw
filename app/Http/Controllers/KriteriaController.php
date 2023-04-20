<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKriteriaRequest;
use App\Http\Requests\UpdateKriteriaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Flash;
use Response;

class KriteriaController extends AppBaseController
{
    /**
     * Display a listing of the Kriteria.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /** @var Kriteria $kriterias */
        $kriterias = Kriteria::all();

        return view('kriterias.index')
            ->with('kriterias', $kriterias);
    }

    /**
     * Show the form for creating a new Kriteria.
     *
     * @return Response
     */
    public function create()
    {
        return view('kriterias.create');
    }

    /**
     * Store a newly created Kriteria in storage.
     *
     * @param CreateKriteriaRequest $request
     *
     * @return Response
     */
    public function store(CreateKriteriaRequest $request)
    {
        $input = $request->all();

        /** @var Kriteria $kriteria */
        $kriteria = Kriteria::create($input);

        Flash::success('Kriteria saved successfully.');

        return redirect(route('kriterias.index'));
    }

    /**
     * Display the specified Kriteria.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Kriteria $kriteria */
        $kriteria = Kriteria::find($id);

        if (empty($kriteria)) {
            Flash::error('Kriteria not found');

            return redirect(route('kriterias.index'));
        }

        return view('kriterias.show')->with('kriteria', $kriteria);
    }

    /**
     * Show the form for editing the specified Kriteria.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Kriteria $kriteria */
        $kriteria = Kriteria::find($id);

        if (empty($kriteria)) {
            Flash::error('Kriteria not found');

            return redirect(route('kriterias.index'));
        }

        return view('kriterias.edit')->with('kriteria', $kriteria);
    }

    /**
     * Update the specified Kriteria in storage.
     *
     * @param int $id
     * @param UpdateKriteriaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKriteriaRequest $request)
    {
        /** @var Kriteria $kriteria */
        $kriteria = Kriteria::find($id);

        if (empty($kriteria)) {
            Flash::error('Kriteria not found');

            return redirect(route('kriterias.index'));
        }

        $kriteria->fill($request->all());
        $kriteria->save();

        Flash::success('Kriteria updated successfully.');

        return redirect(route('kriterias.index'));
    }

    /**
     * Remove the specified Kriteria from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Kriteria $kriteria */
        $kriteria = Kriteria::find($id);

        if (empty($kriteria)) {
            Flash::error('Kriteria not found');

            return redirect(route('kriterias.index'));
        }

        $kriteria->delete();

        Flash::success('Kriteria deleted successfully.');

        return redirect(route('kriterias.index'));
    }
}
