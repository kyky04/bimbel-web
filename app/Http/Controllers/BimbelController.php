<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBimbelRequest;
use App\Http\Requests\UpdateBimbelRequest;
use App\Repositories\BimbelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class BimbelController extends AppBaseController
{
    /** @var  BimbelRepository */
    private $bimbelRepository;

    public function __construct(BimbelRepository $bimbelRepo)
    {
        $this->bimbelRepository = $bimbelRepo;
    }

    /**
     * Display a listing of the Bimbel.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bimbelRepository->pushCriteria(new RequestCriteria($request));
        $bimbels = $this->bimbelRepository->all();

        return view('bimbels.index')
            ->with('bimbels', $bimbels);
    }

    /**
     * Show the form for creating a new Bimbel.
     *
     * @return Response
     */
    public function create()
    {
        return view('bimbels.create');
    }

    /**
     * Store a newly created Bimbel in storage.
     *
     * @param CreateBimbelRequest $request
     *
     * @return Response
     */
    public function store(CreateBimbelRequest $request)
    {
        $input = $request->all();

        $bimbel = $this->bimbelRepository->create($input);

        Flash::success('Bimbel saved successfully.');

        return redirect(route('bimbels.index'));
    }

    /**
     * Display the specified Bimbel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bimbel = $this->bimbelRepository->findWithoutFail($id);

        if (empty($bimbel)) {
            Flash::error('Bimbel not found');

            return redirect(route('bimbels.index'));
        }

        return view('bimbels.show')->with('bimbel', $bimbel);
    }

    /**
     * Show the form for editing the specified Bimbel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bimbel = $this->bimbelRepository->findWithoutFail($id);

        if (empty($bimbel)) {
            Flash::error('Bimbel not found');

            return redirect(route('bimbels.index'));
        }

        return view('bimbels.edit')->with('bimbel', $bimbel);
    }

    /**
     * Update the specified Bimbel in storage.
     *
     * @param  int              $id
     * @param UpdateBimbelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBimbelRequest $request)
    {
        $bimbel = $this->bimbelRepository->findWithoutFail($id);

        if (empty($bimbel)) {
            Flash::error('Bimbel not found');

            return redirect(route('bimbels.index'));
        }

        $bimbel = $this->bimbelRepository->update($request->all(), $id);

        Flash::success('Bimbel updated successfully.');

        return redirect(route('bimbels.index'));
    }

    /**
     * Remove the specified Bimbel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bimbel = $this->bimbelRepository->findWithoutFail($id);

        if (empty($bimbel)) {
            Flash::error('Bimbel not found');

            return redirect(route('bimbels.index'));
        }

        $this->bimbelRepository->delete($id);

        Flash::success('Bimbel deleted successfully.');

        return redirect(route('bimbels.index'));
    }
}
