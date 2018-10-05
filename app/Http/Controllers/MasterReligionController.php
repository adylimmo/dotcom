<?php

namespace App\Http\Controllers;

use App\DataTables\MasterReligionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMasterReligionRequest;
use App\Http\Requests\UpdateMasterReligionRequest;
use App\Repositories\MasterReligionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Auth; // add by dandisy
use Illuminate\Support\Facades\Storage; // add by dandisy

class MasterReligionController extends AppBaseController
{
    /** @var  MasterReligionRepository */
    private $masterReligionRepository;

    public function __construct(MasterReligionRepository $masterReligionRepo)
    {
        $this->middleware('auth');
        $this->masterReligionRepository = $masterReligionRepo;
    }

    /**
     * Display a listing of the MasterReligion.
     *
     * @param MasterReligionDataTable $masterReligionDataTable
     * @return Response
     */
    public function index(MasterReligionDataTable $masterReligionDataTable)
    {
        return $masterReligionDataTable->render('master_religions.index');
    }

    /**
     * Show the form for creating a new MasterReligion.
     *
     * @return Response
     */
    public function create()
    {
        // add by dandisy
        

        // edit by dandisy
        //return view('master_religions.create');
        return view('master_religions.create');
    }

    /**
     * Store a newly created MasterReligion in storage.
     *
     * @param CreateMasterReligionRequest $request
     *
     * @return Response
     */
    public function store(CreateMasterReligionRequest $request)
    {
        $input = $request->all();

        $masterReligion = $this->masterReligionRepository->create($input);

        Flash::success('Master Religion saved successfully.');

        return redirect(route('masterReligions.index'));
    }

    /**
     * Display the specified MasterReligion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $masterReligion = $this->masterReligionRepository->findWithoutFail($id);

        if (empty($masterReligion)) {
            Flash::error('Master Religion not found');

            return redirect(route('masterReligions.index'));
        }

        return view('master_religions.show')->with('masterReligion', $masterReligion);
    }

    /**
     * Show the form for editing the specified MasterReligion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // add by dandisy
        

        $masterReligion = $this->masterReligionRepository->findWithoutFail($id);

        if (empty($masterReligion)) {
            Flash::error('Master Religion not found');

            return redirect(route('masterReligions.index'));
        }

        // edit by dandisy
        //return view('master_religions.edit')->with('masterReligion', $masterReligion);
        return view('master_religions.edit')
            ->with('masterReligion', $masterReligion);        
    }

    /**
     * Update the specified MasterReligion in storage.
     *
     * @param  int              $id
     * @param UpdateMasterReligionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMasterReligionRequest $request)
    {
        $masterReligion = $this->masterReligionRepository->findWithoutFail($id);

        if (empty($masterReligion)) {
            Flash::error('Master Religion not found');

            return redirect(route('masterReligions.index'));
        }

        $masterReligion = $this->masterReligionRepository->update($request->all(), $id);

        Flash::success('Master Religion updated successfully.');

        return redirect(route('masterReligions.index'));
    }

    /**
     * Remove the specified MasterReligion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $masterReligion = $this->masterReligionRepository->findWithoutFail($id);

        if (empty($masterReligion)) {
            Flash::error('Master Religion not found');

            return redirect(route('masterReligions.index'));
        }

        $this->masterReligionRepository->delete($id);

        Flash::success('Master Religion deleted successfully.');

        return redirect(route('masterReligions.index'));
    }
}
