<?php

namespace App\Http\Controllers;

use App\DataTables\AppusersDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateAppusersRequest;
use App\Http\Requests\UpdateAppusersRequest;
use App\Repositories\AppusersRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class AppusersController extends AppBaseController
{
    /** @var  AppusersRepository */
    private $appusersRepository;

    public function __construct(AppusersRepository $appusersRepo)
    {
        $this->appusersRepository = $appusersRepo;
    }

    /**
     * Display a listing of the Appusers.
     *
     * @param AppusersDataTable $appusersDataTable
     * @return Response
     */
    public function index(AppusersDataTable $appusersDataTable)
    {
        return $appusersDataTable->render('backend.appusers.index');
    }

    /**
     * Show the form for creating a new Appusers.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.appusers.create');
    }

    /**
     * Store a newly created Appusers in storage.
     *
     * @param CreateAppusersRequest $request
     *
     * @return Response
     */
    public function store(CreateAppusersRequest $request)
    {
        $input = $request->all();

        $appusers = $this->appusersRepository->create($input);

        Flash::success('Appusers saved successfully.');

        return redirect(route('backend.appusers.index'));
    }

    /**
     * Display the specified Appusers.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $appusers = $this->appusersRepository->findWithoutFail($id);

        if (empty($appusers)) {
            Flash::error('Appusers not found');

            return redirect(route('backend.appusers.index'));
        }

        $profile = $appusers->join('profiles','profiles.id_user','appusers.id')->where('profiles.id_user',$appusers->id)->first();

        return view('backend.appusers.show')->with(array('appusers'=>$appusers,'profile'=>$profile));
    }

    /**
     * Show the form for editing the specified Appusers.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $appusers = $this->appusersRepository->findWithoutFail($id);

        if (empty($appusers)) {
            Flash::error('Appusers not found');

            return redirect(route('backend.appusers.index'));
        }

        return view('backend.appusers.edit')->with('appusers', $appusers);
    }

    /**
     * Update the specified Appusers in storage.
     *
     * @param  int              $id
     * @param UpdateAppusersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAppusersRequest $request)
    {
        $appusers = $this->appusersRepository->findWithoutFail($id);

        if (empty($appusers)) {
            Flash::error('Appusers not found');

            return redirect(route('backend.appusers.index'));
        }

        $appusers = $this->appusersRepository->update($request->all(), $id);

        Flash::success('Appusers updated successfully.');

        return redirect(route('backend.appusers.index'));
    }

    /**
     * Remove the specified Appusers from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $appusers = $this->appusersRepository->findWithoutFail($id);

        if (empty($appusers)) {
            Flash::error('Appusers not found');

            return redirect(route('backend.appusers.index'));
        }

        $this->appusersRepository->delete($id);

        Flash::success('Appusers deleted successfully.');

        return redirect(route('backend.appusers.index'));
    }
}
