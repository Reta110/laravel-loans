<?php

namespace App\Http\Controllers;

use App\DataTables\LoanDataTable;
use App\DataTables\LoanHistoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use App\Repositories\LoanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\User;

class LoanController extends AppBaseController
{
    /** @var  LoanRepository */
    private $loanRepository;

    public function __construct(LoanRepository $loanRepo)
    {
        $this->middleware('isAdmin')->only(['create', 'edit', 'store', 'update', 'delete']);
        $this->loanRepository = $loanRepo;
    }

    /**
     * Display a listing of active Loans.
     *
     * @param LoanDataTable $loanDataTable
     * @return Response
     */
    public function index(LoanDataTable $loanDataTable)
    {
        return $loanDataTable->render('loans.index');
    }

    /**
     * Display a listing all.
     *
     * @param loanHistoryDataTable $loanDataTable
     * @return Response
     */
    public function history(LoanHistoryDataTable $loanHistoryDataTable)
    {
        return $loanHistoryDataTable->render('loans.index');
    }

    /**
     * Show the form for creating a new Loan.
     *
     * @return Response
     */
    public function create()
    {

        $clients = User::whereIn('role', ['admin', 'client'])->orderBy('name', 'ASC')->pluck('name', 'id');
        $users = User::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('loans.create', compact('users', 'clients'));
    }

    /**
     * Store a newly created Loan in storage.
     *
     * @param CreateLoanRequest $request
     *
     * @return Response
     */
    public function store(CreateLoanRequest $request)
    {
        $input = $request->all();

        $clients = User::select('name', 'id', 'percent')->where('total_amount', '>', 0)
        ->whereIn('role', ['admin', 'client'])
        ->get();

        $input['client_percents'] = json_encode($clients);

        $loan = $this->loanRepository->create($input);

        Flash::success('Loan saved successfully.');

        return redirect(route('loans.index'));
    }

    /**
     * Display the specified Loan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $loan = $this->loanRepository->find($id);
        $this->authorize('view', $loan);

        if (empty($loan)) {
            Flash::error('Loan not found');

            return redirect(route('loans.index'));
        }

        return view('loans.show')->with('loan', $loan);
    }

    /**
     * Show the form for editing the specified Loan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $loan = $this->loanRepository->find($id);

        if (empty($loan)) {
            Flash::error('Loan not found');

            return redirect(route('loans.index'));
        }

        $clients = User::whereIn('role', ['admin', 'client'])->orderBy('name', 'ASC')->pluck('name', 'id');
        $users = User::orderBy('name', 'ASC')->pluck('name', 'id');

        return view('loans.edit', compact('loan', 'users', 'clients'));
    }

    /**
     * Update the specified Loan in storage.
     *
     * @param  int              $id
     * @param UpdateLoanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLoanRequest $request)
    {
        $loan = $this->loanRepository->find($id);

        if (empty($loan)) {
            Flash::error('Loan not found');

            return redirect(route('loans.index'));
        }

        $input = $request->all();
        //
        // $clients = User::select('name', 'id', 'percent')->where('total_amount', '>', 0)
        // ->whereIn('role', ['admin', 'client'])
        // ->get();
        //
        // $input['client_percents'] = json_encode($clients);

        $loan = $this->loanRepository->update($input, $id);

        Flash::success('Loan updated successfully.');

        return redirect(route('loans.index'));
    }

    /**
     * Remove the specified Loan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $loan = $this->loanRepository->find($id);

        if (empty($loan)) {
            Flash::error('Loan not found');

            return redirect(route('loans.index'));
        }

        $this->loanRepository->delete($id);

        Flash::success('Loan deleted successfully.');

        return redirect(route('loans.index'));
    }
}
