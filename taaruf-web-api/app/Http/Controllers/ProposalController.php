<?php

namespace App\Http\Controllers;

use App\DataTables\ProposalDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProposalRequest;
use App\Http\Requests\UpdateProposalRequest;
use App\Repositories\ProposalRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Proposal;
use App\FieldProfile;
use App\ProfileData;
use App\Appusers;
class ProposalController extends AppBaseController
{
    /** @var  ProposalRepository */
    private $proposalRepository;

    public function __construct(ProposalRepository $proposalRepo)
    {
        $this->proposalRepository = $proposalRepo;
    }

    /**
     * Display a listing of the Proposal.
     *
     * @param ProposalDataTable $proposalDataTable
     * @return Response
     */
    public function index(ProposalDataTable $proposalDataTable)
    {
        return $proposalDataTable->render('backend.proposals.index');
    }

    /**
     * Show the form for creating a new Proposal.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.proposals.create');
    }

    /**
     * Store a newly created Proposal in storage.
     *
     * @param CreateProposalRequest $request
     *
     * @return Response
     */
    public function store(CreateProposalRequest $request)
    {
        $input = $request->all();

        $proposal = $this->proposalRepository->create($input);

        Flash::success('Proposal saved successfully.');

        return redirect(route('backend.proposals.index'));
    }

    /**
     * Display the specified Proposal.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $proposal = $this->proposalRepository->findWithoutFail($id);

        if (empty($proposal)) {
            Flash::error('Proposal not found');
            return redirect(route('backend.proposals.index'));
        }

        $gender['penerima'] = Appusers::select('gender')->where('appusers.id',$proposal->id_penerima)->first()['gender'];
        $gender['pengirim'] = Appusers::select('gender')->where('appusers.id',$proposal->id_pengirim)->first()['gender'];
        $penerima = $proposal->join('profiles','profiles.id_user','proposal.id_penerima')->first();
        $pengirim = $proposal->join('profiles','profiles.id_user','proposal.id_pengirim')->where('profiles.id_user',$proposal->id_pengirim)->first();
        $profiles['penerima'] = $penerima;
        $profiles['pengirim'] = $pengirim;

        return view('backend.proposals.show')->with(array(
            'proposal'=>$proposal,
            'profiles'=>$profiles,
            'gender'=>$gender
        ));

    }

    /**
     * Show the form for editing the specified Proposal.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $proposal = $this->proposalRepository->findWithoutFail($id);

        if (empty($proposal)) {
            Flash::error('Proposal not found');

            return redirect(route('backend.proposals.index'));
        }

        return view('backend.proposals.edit')->with('proposal', $proposal);
    }

    /**
     * Update the specified Proposal in storage.
     *
     * @param  int              $id
     * @param UpdateProposalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProposalRequest $request)
    {
        $proposal = $this->proposalRepository->findWithoutFail($id);

        if (empty($proposal)) {
            Flash::error('Proposal not found');

            return redirect(route('backend.proposals.index'));
        }

        $proposal = $this->proposalRepository->update($request->all(), $id);

        Flash::success('Proposal updated successfully.');

        return redirect(route('backend.proposals.index'));
    }

    /**
     * Remove the specified Proposal from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $proposal = $this->proposalRepository->findWithoutFail($id);

        if (empty($proposal)) {
            Flash::error('Proposal not found');

            return redirect(route('backend.proposals.index'));
        }

        $this->proposalRepository->delete($id);

        Flash::success('Proposal deleted successfully.');

        return redirect(route('backend.proposals.index'));
    }
}
