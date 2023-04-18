<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKriteriadetailRequest;
use App\Http\Requests\UpdateKriteriadetailRequest;
use App\Http\Controllers\AppBaseController;
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
    public function index(Request $request)
    {
        /** @var Kriteriadetail $kriteriadetails */
        $kriteriadetails = Kriteriadetail::all();

        return view('kriteriadetails.index')
            ->with('kriteriadetails', $kriteriadetails);
    }

    /**
     * Show the form for creating a new Kriteriadetail.
     *
     * @return Response
     */
    public function create()
    {
        return view('kriteriadetails.create');
    }

    /**
     * Store a newly created Kriteriadetail in storage.
     *
     * @param CreateKriteriadetailRequest $request
     *
     * @return Response
     */
    public function store(CreateKriteriadetailRequest $request)
    {
        $input = $request->all();

        /** @var Kriteriadetail $kriteriadetail */
        $kriteriadetail = Kriteriadetail::create($input);

        Flash::success('Kriteriadetail saved successfully.');

        return redirect(route('kriteriadetails.index'));
    }

    /**
     * Display the specified Kriteriadetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Kriteriadetail $kriteriadetail */
        $kriteriadetail = Kriteriadetail::find($id);

        if (empty($kriteriadetail)) {
            Flash::error('Kriteriadetail not found');

            return redirect(route('kriteriadetails.index'));
        }

        return view('kriteriadetails.show')->with('kriteriadetail', $kriteriadetail);
    }

    /**
     * Show the form for editing the specified Kriteriadetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Kriteriadetail $kriteriadetail */
        $kriteriadetail = Kriteriadetail::find($id);

        if (empty($kriteriadetail)) {
            Flash::error('Kriteriadetail not found');

            return redirect(route('kriteriadetails.index'));
        }

        return view('kriteriadetails.edit')->with('kriteriadetail', $kriteriadetail);
    }

    /**
     * Update the specified Kriteriadetail in storage.
     *
     * @param int $id
     * @param UpdateKriteriadetailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKriteriadetailRequest $request)
    {
        /** @var Kriteriadetail $kriteriadetail */
        $kriteriadetail = Kriteriadetail::find($id);

        if (empty($kriteriadetail)) {
            Flash::error('Kriteriadetail not found');

            return redirect(route('kriteriadetails.index'));
        }

        $kriteriadetail->fill($request->all());
        $kriteriadetail->save();

        Flash::success('Kriteriadetail updated successfully.');

        return redirect(route('kriteriadetails.index'));
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
    public function destroy($id)
    {
        /** @var Kriteriadetail $kriteriadetail */
        $kriteriadetail = Kriteriadetail::find($id);

        if (empty($kriteriadetail)) {
            Flash::error('Kriteriadetail not found');

            return redirect(route('kriteriadetails.index'));
        }

        $kriteriadetail->delete();

        Flash::success('Kriteriadetail deleted successfully.');

        return redirect(route('kriteriadetails.index'));
    }
}
