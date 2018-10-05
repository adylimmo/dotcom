<?php

namespace App\Http\Controllers;

use App\DataTables\MasterDepartmenDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMasterDepartmenRequest;
use App\Http\Requests\UpdateMasterDepartmenRequest;
use App\Repositories\MasterDepartmenRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Auth; // add by dandisy
use Illuminate\Support\Facades\Storage; // add by dandisy

class MasterDepartmenController extends AppBaseController
{
    /** @var  MasterDepartmenRepository */
    private $masterDepartmenRepository;

    public function __construct(MasterDepartmenRepository $masterDepartmenRepo)
    {
        $this->middleware('auth');
        $this->masterDepartmenRepository = $masterDepartmenRepo;
    }

    /**
     * Display a listing of the MasterDepartmen.
     *
     * @param MasterDepartmenDataTable $masterDepartmenDataTable
     * @return Response
     */
    public function index(MasterDepartmenDataTable $masterDepartmenDataTable)
    {
        return $masterDepartmenDataTable->render('master_departmens.index');
    }

    /**
     * Show the form for creating a new MasterDepartmen.
     *
     * @return Response
     */
    public function create()
    {
        // add by dandisy
        

        // edit by dandisy
        //return view('master_departmens.create');
        //return view('master_departmens.create');
        $isidivisi = \App\Models\MasterDivision::get();
        //dd($isidivisi);
        // edit by dandisy
        //return view('admin.master_departments.create');
        return view('master_departmens.create')->with('isidivisi', $isidivisi);
    }

    /**
     * Store a newly created MasterDepartmen in storage.
     *
     * @param CreateMasterDepartmenRequest $request
     *
     * @return Response
     */
    public function store(CreateMasterDepartmenRequest $request)
    {
        $input = $request->all();

        $masterDepartmen = $this->masterDepartmenRepository->create($input);

        Flash::success('Master Departmen saved successfully.');

        return redirect(route('masterDepartmens.index'));
    }

    /**
     * Display the specified MasterDepartmen.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $masterDepartmen = $this->masterDepartmenRepository->findWithoutFail($id);

        if (empty($masterDepartmen)) {
            Flash::error('Master Departmen not found');

            return redirect(route('masterDepartmens.index'));
        }

        return view('master_departmens.show')->with('masterDepartmen', $masterDepartmen);
    }

    /**
     * Show the form for editing the specified MasterDepartmen.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // add by dandisy
        $isidivisi = \App\Models\MasterDivision::get();

        $masterDepartmen = $this->masterDepartmenRepository->findWithoutFail($id);

        if (empty($masterDepartmen)) {
            Flash::error('Master Departmen not found');

            return redirect(route('masterDepartmens.index'));
        }

        // edit by dandisy
        //return view('master_departmens.edit')->with('masterDepartmen', $masterDepartmen);
        return view('master_departmens.edit')
        ->with('isidivisi', $isidivisi)
            ->with('masterDepartmen', $masterDepartmen);        
    }

    /**
     * Update the specified MasterDepartmen in storage.
     *
     * @param  int              $id
     * @param UpdateMasterDepartmenRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMasterDepartmenRequest $request)
    {
        $masterDepartmen = $this->masterDepartmenRepository->findWithoutFail($id);

        if (empty($masterDepartmen)) {
            Flash::error('Master Departmen not found');

            return redirect(route('masterDepartmens.index'));
        }

        $masterDepartmen = $this->masterDepartmenRepository->update($request->all(), $id);

        Flash::success('Master Departmen updated successfully.');

        return redirect(route('masterDepartmens.index'));
    }

    /**
     * Remove the specified MasterDepartmen from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $masterDepartmen = $this->masterDepartmenRepository->findWithoutFail($id);

        if (empty($masterDepartmen)) {
            Flash::error('Master Departmen not found');

            return redirect(route('masterDepartmens.index'));
        }

        $this->masterDepartmenRepository->delete($id);

        Flash::success('Master Departmen deleted successfully.');

        return redirect(route('masterDepartmens.index'));
    }
}
