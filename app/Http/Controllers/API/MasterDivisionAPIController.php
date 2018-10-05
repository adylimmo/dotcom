<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMasterDivisionAPIRequest;
use App\Http\Requests\API\UpdateMasterDivisionAPIRequest;
use App\Models\MasterDivision;
use App\Repositories\MasterDivisionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MasterDivisionController
 * @package App\Http\Controllers\API
 */

class MasterDivisionAPIController extends AppBaseController
{
    /** @var  MasterDivisionRepository */
    private $masterDivisionRepository;

    public function __construct(MasterDivisionRepository $masterDivisionRepo)
    {
        $this->middleware('auth:api');
        $this->masterDivisionRepository = $masterDivisionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/masterDivisions",
     *      summary="Get a listing of the MasterDivisions.",
     *      tags={"MasterDivision"},
     *      description="Get all MasterDivisions",
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
     *                  @SWG\Items(ref="#/definitions/MasterDivision")
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
        $this->masterDivisionRepository->pushCriteria(new RequestCriteria($request));
        $this->masterDivisionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $masterDivisions = $this->masterDivisionRepository->all();

        return $this->sendResponse($masterDivisions->toArray(), 'Master Divisions retrieved successfully');
    }

    /**
     * @param CreateMasterDivisionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/masterDivisions",
     *      summary="Store a newly created MasterDivision in storage",
     *      tags={"MasterDivision"},
     *      description="Store MasterDivision",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MasterDivision that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MasterDivision")
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
     *                  ref="#/definitions/MasterDivision"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMasterDivisionAPIRequest $request)
    {
        $input = $request->all();

        $masterDivisions = $this->masterDivisionRepository->create($input);

        return $this->sendResponse($masterDivisions->toArray(), 'Master Division saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/masterDivisions/{id}",
     *      summary="Display the specified MasterDivision",
     *      tags={"MasterDivision"},
     *      description="Get MasterDivision",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MasterDivision",
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
     *                  ref="#/definitions/MasterDivision"
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
        /** @var MasterDivision $masterDivision */
        $masterDivision = $this->masterDivisionRepository->findWithoutFail($id);

        if (empty($masterDivision)) {
            return $this->sendError('Master Division not found');
        }

        return $this->sendResponse($masterDivision->toArray(), 'Master Division retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMasterDivisionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/masterDivisions/{id}",
     *      summary="Update the specified MasterDivision in storage",
     *      tags={"MasterDivision"},
     *      description="Update MasterDivision",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MasterDivision",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MasterDivision that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MasterDivision")
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
     *                  ref="#/definitions/MasterDivision"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMasterDivisionAPIRequest $request)
    {
        $input = $request->all();

        /** @var MasterDivision $masterDivision */
        $masterDivision = $this->masterDivisionRepository->findWithoutFail($id);

        if (empty($masterDivision)) {
            return $this->sendError('Master Division not found');
        }

        $masterDivision = $this->masterDivisionRepository->update($input, $id);

        return $this->sendResponse($masterDivision->toArray(), 'MasterDivision updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/masterDivisions/{id}",
     *      summary="Remove the specified MasterDivision from storage",
     *      tags={"MasterDivision"},
     *      description="Delete MasterDivision",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MasterDivision",
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
        /** @var MasterDivision $masterDivision */
        $masterDivision = $this->masterDivisionRepository->findWithoutFail($id);

        if (empty($masterDivision)) {
            return $this->sendError('Master Division not found');
        }

        $masterDivision->delete();

        return $this->sendResponse($id, 'Master Division deleted successfully');
    }
}
