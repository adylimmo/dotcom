<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMasterDepartmenAPIRequest;
use App\Http\Requests\API\UpdateMasterDepartmenAPIRequest;
use App\Models\MasterDepartmen;
use App\Repositories\MasterDepartmenRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MasterDepartmenController
 * @package App\Http\Controllers\API
 */

class MasterDepartmenAPIController extends AppBaseController
{
    /** @var  MasterDepartmenRepository */
    private $masterDepartmenRepository;

    public function __construct(MasterDepartmenRepository $masterDepartmenRepo)
    {
        $this->middleware('auth:api');
        $this->masterDepartmenRepository = $masterDepartmenRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/masterDepartmens",
     *      summary="Get a listing of the MasterDepartmens.",
     *      tags={"MasterDepartmen"},
     *      description="Get all MasterDepartmens",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/MasterDepartmen")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->masterDepartmenRepository->pushCriteria(new RequestCriteria($request));
        $this->masterDepartmenRepository->pushCriteria(new LimitOffsetCriteria($request));
        $masterDepartmens = $this->masterDepartmenRepository->all();

        return $this->sendResponse($masterDepartmens->toArray(), 'Master Departmens retrieved successfully');
    }

    /**
     * @param CreateMasterDepartmenAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/masterDepartmens",
     *      summary="Store a newly created MasterDepartmen in storage",
     *      tags={"MasterDepartmen"},
     *      description="Store MasterDepartmen",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MasterDepartmen that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MasterDepartmen")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/MasterDepartmen"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMasterDepartmenAPIRequest $request)
    {
        $input = $request->all();

        $masterDepartmens = $this->masterDepartmenRepository->create($input);

        return $this->sendResponse($masterDepartmens->toArray(), 'Master Departmen saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/masterDepartmens/{id}",
     *      summary="Display the specified MasterDepartmen",
     *      tags={"MasterDepartmen"},
     *      description="Get MasterDepartmen",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MasterDepartmen",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/MasterDepartmen"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var MasterDepartmen $masterDepartmen */
        $masterDepartmen = $this->masterDepartmenRepository->findWithoutFail($id);

        if (empty($masterDepartmen)) {
            return $this->sendError('Master Departmen not found');
        }

        return $this->sendResponse($masterDepartmen->toArray(), 'Master Departmen retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMasterDepartmenAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/masterDepartmens/{id}",
     *      summary="Update the specified MasterDepartmen in storage",
     *      tags={"MasterDepartmen"},
     *      description="Update MasterDepartmen",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MasterDepartmen",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MasterDepartmen that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MasterDepartmen")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/MasterDepartmen"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMasterDepartmenAPIRequest $request)
    {
        $input = $request->all();

        /** @var MasterDepartmen $masterDepartmen */
        $masterDepartmen = $this->masterDepartmenRepository->findWithoutFail($id);

        if (empty($masterDepartmen)) {
            return $this->sendError('Master Departmen not found');
        }

        $masterDepartmen = $this->masterDepartmenRepository->update($input, $id);

        return $this->sendResponse($masterDepartmen->toArray(), 'MasterDepartmen updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/masterDepartmens/{id}",
     *      summary="Remove the specified MasterDepartmen from storage",
     *      tags={"MasterDepartmen"},
     *      description="Delete MasterDepartmen",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MasterDepartmen",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var MasterDepartmen $masterDepartmen */
        $masterDepartmen = $this->masterDepartmenRepository->findWithoutFail($id);

        if (empty($masterDepartmen)) {
            return $this->sendError('Master Departmen not found');
        }

        $masterDepartmen->delete();

        return $this->sendResponse($id, 'Master Departmen deleted successfully');
    }
}
