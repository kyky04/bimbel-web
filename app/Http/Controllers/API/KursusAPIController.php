<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKursusAPIRequest;
use App\Http\Requests\API\UpdateKursusAPIRequest;
use App\Models\Kursus;
use App\Repositories\KursusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class KursusController
 * @package App\Http\Controllers\API
 */

class KursusAPIController extends AppBaseController
{
    /** @var  KursusRepository */
    private $kursusRepository;

    public function __construct(KursusRepository $kursusRepo)
    {
        $this->kursusRepository = $kursusRepo;
    }

    /**
     * Display a listing of the Kursus.
     * GET|HEAD /kursuses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->kursusRepository->pushCriteria(new RequestCriteria($request));
        $this->kursusRepository->pushCriteria(new LimitOffsetCriteria($request));
        $kursuses = $this->kursusRepository->all();

        return $this->sendResponse($kursuses->toArray(), 'Kursuses retrieved successfully');
    }

    /**
     * Store a newly created Kursus in storage.
     * POST /kursuses
     *
     * @param CreateKursusAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateKursusAPIRequest $request)
    {
        $input = $request->all();

        $kursuses = $this->kursusRepository->create($input);

        return $this->sendResponse($kursuses->toArray(), 'Kursus saved successfully');
    }

    /**
     * Display the specified Kursus.
     * GET|HEAD /kursuses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Kursus $kursus */
        $kursus = $this->kursusRepository->findWithoutFail($id);

        if (empty($kursus)) {
            return $this->sendError('Kursus not found');
        }

        return $this->sendResponse($kursus->toArray(), 'Kursus retrieved successfully');
    }

    /**
     * Update the specified Kursus in storage.
     * PUT/PATCH /kursuses/{id}
     *
     * @param  int $id
     * @param UpdateKursusAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKursusAPIRequest $request)
    {
        $input = $request->all();

        /** @var Kursus $kursus */
        $kursus = $this->kursusRepository->findWithoutFail($id);

        if (empty($kursus)) {
            return $this->sendError('Kursus not found');
        }

        $kursus = $this->kursusRepository->update($input, $id);

        return $this->sendResponse($kursus->toArray(), 'Kursus updated successfully');
    }

    /**
     * Remove the specified Kursus from storage.
     * DELETE /kursuses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Kursus $kursus */
        $kursus = $this->kursusRepository->findWithoutFail($id);

        if (empty($kursus)) {
            return $this->sendError('Kursus not found');
        }

        $kursus->delete();

        return $this->sendResponse($id, 'Kursus deleted successfully');
    }
}
