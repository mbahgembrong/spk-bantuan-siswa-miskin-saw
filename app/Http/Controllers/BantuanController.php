<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Http\Requests\CreateBantuanRequest;
use App\Http\Requests\UpdateBantuanRequest;

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
