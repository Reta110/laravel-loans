<?php

namespace App\Http\Controllers;

use App\DataTables\DepositDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDepositRequest;
use App\Http\Requests\UpdateDepositRequest;
use App\Mail\DepositCreated;
use App\Repositories\DepositRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Mail;
use Response;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;

class DepositController extends AppBaseController
{
    /** @var  DepositRepository */
    private $depositRepository;

    public function __construct(DepositRepository $depositRepo)
    {
        //$this->middleware('isAdmin')->only(['create', 'edit', 'store', 'update', 'delete']);
        $this->depositRepository = $depositRepo;
    }

    /**
     * Display a listing of the Deposit.
     *
     * @param DepositDataTable $depositDataTable
     * @return Response
     */
    public function index(DepositDataTable $depositDataTable)
    {
        return $depositDataTable->render('deposits.index');
    }

    /**
     * Show the form for creating a new Deposit.
     *
     * @return Response
     */
    public function create()
    {

        $users = User::whereIn('role', ['admin', 'client'])->pluck('name', 'id');

        return view('deposits.create', compact('users'));
    }

    /**
     * Store a newly created Deposit in storage.
     *
     * @param CreateDepositRequest $request
     *
     * @return Response
     */
    public function store(CreateDepositRequest $request)
    {
        $input = $request->all();

        $deposit = $this->depositRepository->create($input);

        Mail::to($deposit->user->email)
            ->send(new DepositCreated($deposit));

        $this->recalculateTotalAmountAndPercents();

        Flash::success('Deposit saved successfully.');

        return redirect(route('deposits.index'));
    }

    /**
     * Display the specified Deposit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deposit = $this->depositRepository->find($id);

        if (empty($deposit)) {
            Flash::error('Deposit not found');

            return redirect(route('deposits.index'));
        }

        return view('deposits.show')->with('deposit', $deposit);
    }

    /**
     * Show the form for editing the specified Deposit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deposit = $this->depositRepository->find($id);

        if (empty($deposit)) {
            Flash::error('Deposit not found');

            return redirect(route('deposits.index'));
        }

        $users = User::whereIn('role', ['admin', 'client'])->pluck('name', 'id');

        return view('deposits.edit', compact('deposit', 'users'));
    }

    /**
     * Update the specified Deposit in storage.
     *
     * @param  int              $id
     * @param UpdateDepositRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDepositRequest $request)
    {
        $deposit = $this->depositRepository->find($id);

        if (empty($deposit)) {
            Flash::error('Deposit not found');

            return redirect(route('deposits.index'));
        }

        $deposit = $this->depositRepository->update($request->all(), $id);

        $this->recalculateTotalAmountAndPercents();

        Flash::success('Deposit updated successfully.');

        return redirect(route('deposits.index'));
    }

    /**
     * Remove the specified Deposit from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deposit = $this->depositRepository->find($id);

        if (empty($deposit)) {
            Flash::error('Deposit not found');

            return redirect(route('deposits.index'));
        }

        $this->depositRepository->delete($id);

        $this->recalculateTotalAmountAndPercents();

        Flash::success('Deposit deleted successfully.');

        return redirect(route('deposits.index'));
    }
}
