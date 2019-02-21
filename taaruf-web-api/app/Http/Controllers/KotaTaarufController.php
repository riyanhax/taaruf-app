<?php

namespace App\Http\Controllers;

use App\DataTables\KotaTaarufDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateKotaTaarufRequest;
use App\Http\Requests\UpdateKotaTaarufRequest;
use App\Repositories\KotaTaarufRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class KotaTaarufController extends AppBaseController
{
    /** @var  KotaTaarufRepository */
    private $kotaTaarufRepository;

    public function __construct(KotaTaarufRepository $kotaTaarufRepo)
    {
        $this->kotaTaarufRepository = $kotaTaarufRepo;
    }

    /**
     * Display a listing of the KotaTaaruf.
     *
     * @param KotaTaarufDataTable $kotaTaarufDataTable
     * @return Response
     */
    public function index(KotaTaarufDataTable $kotaTaarufDataTable)
    {
        return $kotaTaarufDataTable->render('backend.kota_taarufs.index');
    }

    /**
     * Show the form for creating a new KotaTaaruf.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.kota_taarufs.create');
    }

    /**
     * Store a newly created KotaTaaruf in storage.
     *
     * @param CreateKotaTaarufRequest $request
     *
     * @return Response
     */
    public function store(CreateKotaTaarufRequest $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'city' => 'required',
            'province' => 'required',
            'subdistrict' => 'required',
            'address' => 'required'
        ]);
        $input = $request->all();

        $kotaTaaruf = $this->kotaTaarufRepository->create($input);

        Flash::success('Kota Taaruf saved successfully.');

        return redirect(route('backend.kotaTaarufs.index'));
    }

    /**
     * Display the specified KotaTaaruf.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $kotaTaaruf = $this->kotaTaarufRepository->findWithoutFail($id);

        if (empty($kotaTaaruf)) {
            Flash::error('Kota Taaruf not found');

            return redirect(route('backend.kotaTaarufs.index'));
        }

        return view('backend.kota_taarufs.show')->with('kotaTaaruf', $kotaTaaruf);
    }

    /**
     * Show the form for editing the specified KotaTaaruf.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $kotaTaaruf = $this->kotaTaarufRepository->findWithoutFail($id);

        if (empty($kotaTaaruf)) {
            Flash::error('Kota Taaruf not found');

            return redirect(route('backend.kotaTaarufs.index'));
        }

        return view('backend.kota_taarufs.edit')->with('kotaTaaruf', $kotaTaaruf);
    }

    /**
     * Update the specified KotaTaaruf in storage.
     *
     * @param  int              $id
     * @param UpdateKotaTaarufRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKotaTaarufRequest $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'city' => 'required',
            'province' => 'required',
            'subdistrict' => 'required',
            'address' => 'required'
        ]);
        $kotaTaaruf = $this->kotaTaarufRepository->findWithoutFail($id);

        if (empty($kotaTaaruf)) {
            Flash::error('Kota Taaruf not found');

            return redirect(route('backend.kotaTaarufs.index'));
        }

        $kotaTaaruf = $this->kotaTaarufRepository->update($request->all(), $id);

        Flash::success('Kota Taaruf updated successfully.');

        return redirect(route('backend.kotaTaarufs.index'));
    }

    /**
     * Remove the specified KotaTaaruf from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $kotaTaaruf = $this->kotaTaarufRepository->findWithoutFail($id);

        if (empty($kotaTaaruf)) {
            Flash::error('Kota Taaruf not found');

            return redirect(route('backend.kotaTaarufs.index'));
        }

        $this->kotaTaarufRepository->delete($id);

        Flash::success('Kota Taaruf deleted successfully.');

        return redirect(route('backend.kotaTaarufs.index'));
    }
}
