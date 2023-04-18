<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Siswa;
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
        return view('siswas.create');
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

        /** @var Siswa $siswa */
        $siswa = Siswa::create($input);

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

        return view('siswas.edit')->with('siswa', $siswa);
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

        $siswa->fill($request->all());
        $siswa->save();

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
