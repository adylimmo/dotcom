<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMasterReligionAPIRequest;
use App\Http\Requests\API\UpdateMasterReligionAPIRequest;
use App\Models\MasterReligion;
use App\Repositories\MasterReligionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MasterReligionController
 * @package App\Http\Controllers\API
 */

class MasterReligionAPIController extends AppBaseController
{
    /** @var  MasterReligionRepository */
    private $masterReligionRepository;

    public function __construct(MasterReligionRepository $masterReligionRepo)
    {
        $this->middleware('auth:api');
        $this->masterReligionRepository = $masterReligionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/masterReligions",
     *      summary="Get a listing of the MasterReligions.",
     *      tags={"MasterReligion"},
     *      description="Get all MasterReligions",
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
     *                  @SWG\Items(ref="#/definitions/MasterReligion")
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
        $this->masterReligionRepository->pushCriteria(new RequestCriteria($request));
        $this->masterReligionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $masterReligions = $this->masterReligionRepository->all();

        return $this->sendResponse($masterReligions->toArray(), 'Master Religions retrieved successfully');
    }

    /**
     * @param CreateMasterReligionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/masterReligions",
     *      summary="Store a newly created MasterReligion in storage",
     *      tags={"MasterReligion"},
     *      description="Store MasterReligion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MasterReligion that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MasterReligion")
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
     *                  ref="#/definitions/MasterReligion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMasterReligionAPIRequest $request)
    {
        $input = $request->all();

        $masterReligions = $this->masterReligionRepository->create($input);

        return $this->sendResponse($masterReligions->toArray(), 'Master Religion saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/masterReligions/{id}",
     *      summary="Display the specified MasterReligion",
     *      tags={"MasterReligion"},
     *      description="Get MasterReligion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MasterReligion",
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
     *                  ref="#/definitions/MasterReligion"
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
        /** @var MasterReligion $masterReligion */
        $masterReligion = $this->masterReligionRepository->findWithoutFail($id);

        if (empty($masterReligion)) {
            return $this->sendError('Master Religion not found');
        }

        return $this->sendResponse($masterReligion->toArray(), 'Master Religion retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMasterReligionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/masterReligions/{id}",
     *      summary="Update the specified MasterReligion in storage",
     *      tags={"MasterReligion"},
     *      description="Update MasterReligion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MasterReligion",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MasterReligion that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MasterReligion")
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
     *                  ref="#/definitions/MasterReligion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMasterReligionAPIRequest $request)
    {
        $input = $request->all();

        /** @var MasterReligion $masterReligion */
        $masterReligion = $this->masterReligionRepository->findWithoutFail($id);

        if (empty($masterReligion)) {
            return $this->sendError('Master Religion not found');
        }

        $masterReligion = $this->masterReligionRepository->update($input, $id);

        return $this->sendResponse($masterReligion->toArray(), 'MasterReligion updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/masterReligions/{id}",
     *      summary="Remove the specified MasterReligion from storage",
     *      tags={"MasterReligion"},
     *      description="Delete MasterReligion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MasterReligion",
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
        /** @var MasterReligion $masterReligion */
        $masterReligion = $this->masterReligionRepository->findWithoutFail($id);

        if (empty($masterReligion)) {
            return $this->sendError('Master Religion not found');
        }

        $masterReligion->delete();

        return $this->sendResponse($id, 'Master Religion deleted successfully');
    }
}
