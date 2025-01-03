<?php

namespace App\Http\Controllers;

use App\DataTables\WithdrawalDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateWithdrawalRequest;
use App\Http\Requests\UpdateWithdrawalRequest;
use App\Mail\WithdarwalCreated;
use App\Repositories\WithdrawalRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Mail;
use Response;
use App\Models\User;

class WithdrawalController extends AppBaseController
{
    /** @var  WithdrawalRepository */
    private $withdrawalRepository;

    public function __construct(WithdrawalRepository $withdrawalRepo)
    {
        $this->middleware('isAdmin')->only(['create', 'edit', 'store', 'update', 'delete']);
        $this->withdrawalRepository = $withdrawalRepo;
    }

    /**
     * Display a listing of the Withdrawal.
     *
     * @param WithdrawalDataTable $withdrawalDataTable
     * @return Response
     */
    public function index(WithdrawalDataTable $withdrawalDataTable)
    {
        return $withdrawalDataTable->render('withdrawals.index');
    }

    /**
     * Show the form for creating a new Withdrawal.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::whereIn('role', ['admin', 'client'])->pluck('name', 'id');

        return view('withdrawals.create', compact('users'));
    }

    /**
     * Store a newly created Withdrawal in storage.
     *
     * @param CreateWithdrawalRequest $request
     *
     * @return Response
     */
    public function store(CreateWithdrawalRequest $request)
    {
        $input = $request->all();

        $withdrawal = $this->withdrawalRepository->create($input);

        Mail::to($withdrawal->user->email)
            ->send(new WithdarwalCreated($withdrawal));

        $this->recalculateTotalAmountAndPercents();

        Flash::success('Withdrawal saved successfully.');

        return redirect(route('withdrawals.index'));
    }

    /**
     * Display the specified Withdrawal.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $withdrawal = $this->withdrawalRepository->find($id);

        if (empty($withdrawal)) {
            Flash::error('Withdrawal not found');

            return redirect(route('withdrawals.index'));
        }

        return view('withdrawals.show')->with('withdrawal', $withdrawal);
    }

    /**
     * Show the form for editing the specified Withdrawal.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $withdrawal = $this->withdrawalRepository->find($id);

        if (empty($withdrawal)) {
            Flash::error('Withdrawal not found');

            return redirect(route('withdrawals.index'));
        }

        $users = User::whereIn('role', ['admin', 'client'])->pluck('name', 'id');

        return view('withdrawals.edit', compact('withdrawal', 'users'));
    }

    /**
     * Update the specified Withdrawal in storage.
     *
     * @param  int              $id
     * @param UpdateWithdrawalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWithdrawalRequest $request)
    {
        $withdrawal = $this->withdrawalRepository->find($id);

        if (empty($withdrawal)) {
            Flash::error('Withdrawal not found');

            return redirect(route('withdrawals.index'));
        }

        $withdrawal = $this->withdrawalRepository->update($request->all(), $id);

        $this->recalculateTotalAmountAndPercents();

        Flash::success('Withdrawal updated successfully.');

        return redirect(route('withdrawals.index'));
    }

    /**
     * Remove the specified Withdrawal from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $withdrawal = $this->withdrawalRepository->find($id);

        if (empty($withdrawal)) {
            Flash::error('Withdrawal not found');

            return redirect(route('withdrawals.index'));
        }

        $this->withdrawalRepository->delete($id);

        $this->recalculateTotalAmountAndPercents();

        Flash::success('Withdrawal deleted successfully.');

        return redirect(route('withdrawals.index'));
    }
}
