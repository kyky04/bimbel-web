<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKursusRequest;
use App\Http\Requests\UpdateKursusRequest;
use App\Repositories\KursusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class KursusController extends AppBaseController
{
    /** @var  KursusRepository */
    private $kursusRepository;

    public function __construct(KursusRepository $kursusRepo)
    {
        $this->kursusRepository = $kursusRepo;
    }

    /**
     * Display a listing of the Kursus.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->kursusRepository->pushCriteria(new RequestCriteria($request));
        $kursuses = $this->kursusRepository->all();

        return view('kursuses.index')
            ->with('kursuses', $kursuses);
    }

    /**
     * Show the form for creating a new Kursus.
     *
     * @return Response
     */
    public function create()
    {
        return view('kursuses.create');
    }

    /**
     * Store a newly created Kursus in storage.
     *
     * @param CreateKursusRequest $request
     *
     * @return Response
     */
    public function store(CreateKursusRequest $request)
    {
        $input = $request->all();

        $kursus = $this->kursusRepository->create($input);

        Flash::success('Kursus saved successfully.');

        return redirect(route('kursuses.index'));
    }

    /**
     * Display the specified Kursus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $kursus = $this->kursusRepository->findWithoutFail($id);

        if (empty($kursus)) {
            Flash::error('Kursus not found');

            return redirect(route('kursuses.index'));
        }

        return view('kursuses.show')->with('kursus', $kursus);
    }

    /**
     * Show the form for editing the specified Kursus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $kursus = $this->kursusRepository->findWithoutFail($id);

        if (empty($kursus)) {
            Flash::error('Kursus not found');

            return redirect(route('kursuses.index'));
        }

        return view('kursuses.edit')->with('kursus', $kursus);
    }

    /**
     * Update the specified Kursus in storage.
     *
     * @param  int              $id
     * @param UpdateKursusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKursusRequest $request)
    {
        $kursus = $this->kursusRepository->findWithoutFail($id);

        if (empty($kursus)) {
            Flash::error('Kursus not found');

            return redirect(route('kursuses.index'));
        }

        $kursus = $this->kursusRepository->update($request->all(), $id);

        Flash::success('Kursus updated successfully.');

        return redirect(route('kursuses.index'));
    }

    /**
     * Remove the specified Kursus from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $kursus = $this->kursusRepository->findWithoutFail($id);

        if (empty($kursus)) {
            Flash::error('Kursus not found');

            return redirect(route('kursuses.index'));
        }

        $this->kursusRepository->delete($id);

        Flash::success('Kursus deleted successfully.');

        return redirect(route('kursuses.index'));
    }
}
