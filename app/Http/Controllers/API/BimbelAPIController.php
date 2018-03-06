<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBimbelAPIRequest;
use App\Http\Requests\API\UpdateBimbelAPIRequest;
use App\Models\Bimbel;
use App\Repositories\BimbelRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BimbelController
 * @package App\Http\Controllers\API
 */

class BimbelAPIController extends AppBaseController
{
    /** @var  BimbelRepository */
    private $bimbelRepository;

    public function __construct(BimbelRepository $bimbelRepo)
    {
        $this->bimbelRepository = $bimbelRepo;
    }

    /**
     * Display a listing of the Bimbel.
     * GET|HEAD /bimbels
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bimbelRepository->pushCriteria(new RequestCriteria($request));
        $this->bimbelRepository->pushCriteria(new LimitOffsetCriteria($request));
        $bimbels = $this->bimbelRepository->all();

        return $this->sendResponse($bimbels->toArray(), 'Bimbels retrieved successfully');
    }

    /**
     * Store a newly created Bimbel in storage.
     * POST /bimbels
     *
     * @param CreateBimbelAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBimbelAPIRequest $request)
    {
        $input = $request->all();

        $bimbels = $this->bimbelRepository->create($input);

        return $this->sendResponse($bimbels->toArray(), 'Bimbel saved successfully');
    }

    /**
     * Display the specified Bimbel.
     * GET|HEAD /bimbels/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Bimbel $bimbel */
        $bimbel = $this->bimbelRepository->findWithoutFail($id);

        if (empty($bimbel)) {
            return $this->sendError('Bimbel not found');
        }

        return $this->sendResponse($bimbel->toArray(), 'Bimbel retrieved successfully');
    }

    /**
     * Update the specified Bimbel in storage.
     * PUT/PATCH /bimbels/{id}
     *
     * @param  int $id
     * @param UpdateBimbelAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBimbelAPIRequest $request)
    {
        $input = $request->all();

        /** @var Bimbel $bimbel */
        $bimbel = $this->bimbelRepository->findWithoutFail($id);

        if (empty($bimbel)) {
            return $this->sendError('Bimbel not found');
        }

        $bimbel = $this->bimbelRepository->update($input, $id);

        return $this->sendResponse($bimbel->toArray(), 'Bimbel updated successfully');
    }

    /**
     * Remove the specified Bimbel from storage.
     * DELETE /bimbels/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Bimbel $bimbel */
        $bimbel = $this->bimbelRepository->findWithoutFail($id);

        if (empty($bimbel)) {
            return $this->sendError('Bimbel not found');
        }

        $bimbel->delete();

        return $this->sendResponse($id, 'Bimbel deleted successfully');
    }
}
