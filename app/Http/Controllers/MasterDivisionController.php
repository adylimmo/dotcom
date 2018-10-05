<?php

namespace App\Http\Controllers;

use App\DataTables\MasterDivisionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMasterDivisionRequest;
use App\Http\Requests\UpdateMasterDivisionRequest;
use App\Repositories\MasterDivisionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Auth; // add by dandisy
use Illuminate\Support\Facades\Storage; // add by dandisy

class MasterDivisionController extends AppBaseController
{
    /** @var  MasterDivisionRepository */
    private $masterDivisionRepository;

    public function __construct(MasterDivisionRepository $masterDivisionRepo)
    {
        $this->middleware('auth');
        $this->masterDivisionRepository = $masterDivisionRepo;
    }

    /**
     * Display a listing of the MasterDivision.
     *
     * @param MasterDivisionDataTable $masterDivisionDataTable
     * @return Response
     */
    public function index(MasterDivisionDataTable $masterDivisionDataTable)
    {
        return $masterDivisionDataTable->render('master_divisions.index');
    }

    /**
     * Show the form for creating a new MasterDivision.
     *
     * @return Response
     */
    public function create()
    {
        // add by dandisy
        

        // edit by dandisy
        //return view('master_divisions.create');
        return view('master_divisions.create');
    }

    /**
     * Store a newly created MasterDivision in storage.
     *
     * @param CreateMasterDivisionRequest $request
     *
     * @return Response
     */
    public function store(CreateMasterDivisionRequest $request)
    {
        $input = $request->all();

        $masterDivision = $this->masterDivisionRepository->create($input);

        Flash::success('Master Division saved successfully.');

        return redirect(route('masterDivisions.index'));
    }

    /**
     * Display the specified MasterDivision.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $masterDivision = $this->masterDivisionRepository->findWithoutFail($id);

        if (empty($masterDivision)) {
            Flash::error('Master Division not found');

            return redirect(route('masterDivisions.index'));
        }

        return view('master_divisions.show')->with('masterDivision', $masterDivision);
    }

    /**
     * Show the form for editing the specified MasterDivision.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // add by dandisy
        

        $masterDivision = $this->masterDivisionRepository->findWithoutFail($id);

        if (empty($masterDivision)) {
            Flash::error('Master Division not found');

            return redirect(route('masterDivisions.index'));
        }

        // edit by dandisy
        //return view('master_divisions.edit')->with('masterDivision', $masterDivision);
        return view('master_divisions.edit')
            ->with('masterDivision', $masterDivision);        
    }

    /**
     * Update the specified MasterDivision in storage.
     *
     * @param  int              $id
     * @param UpdateMasterDivisionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMasterDivisionRequest $request)
    {
        $masterDivision = $this->masterDivisionRepository->findWithoutFail($id);

        if (empty($masterDivision)) {
            Flash::error('Master Division not found');

            return redirect(route('masterDivisions.index'));
        }

        $masterDivision = $this->masterDivisionRepository->update($request->all(), $id);

        Flash::success('Master Division updated successfully.');

        return redirect(route('masterDivisions.index'));
    }

    /**
     * Remove the specified MasterDivision from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $masterDivision = $this->masterDivisionRepository->findWithoutFail($id);

        if (empty($masterDivision)) {
            Flash::error('Master Division not found');

            return redirect(route('masterDivisions.index'));
        }

        $this->masterDivisionRepository->delete($id);

        Flash::success('Master Division deleted successfully.');

        return redirect(route('masterDivisions.index'));
    }
}
