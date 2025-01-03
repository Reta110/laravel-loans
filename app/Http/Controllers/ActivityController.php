<?php

namespace App\Http\Controllers;

use App\DataTables\ActivityDataTable;
use App\Http\Requests\CreateActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Repositories\ActivityRepository;
use Flash;
use Response;
use App\Models\Loan;
use App\Models\User;
use App\Models\ActivityType;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivityCreated;

class ActivityController extends AppBaseController
{
    /** @var  ActivityRepository */
    private $activityRepository;

    public function __construct(ActivityRepository $activityRepo)
    {
        $this->middleware('isAdmin')->only(['create', 'edit', 'store', 'update', 'delete']);
        $this->activityRepository = $activityRepo;
    }

    /**
     * Display a listing of the Activity.
     *
     * @param ActivityDataTable $activityDataTable
     * @return Response
     */
    public function index(ActivityDataTable $activityDataTable)
    {
        return $activityDataTable->render('activities.index');
    }

    /**
     * Show the form for creating a new Activity.
     *
     * @return Response
     */
    public function create()
    {
        $loans = Loan::with('activities', 'user')
            ->where('finished', false)
            ->get();

        $activities = ActivityType::pluck('name', 'id');

        return view('activities.create', compact('loans', 'activities'));
    }

    /**
     * Store a newly created Activity in storage.
     *
     * @param CreateActivityRequest $request
     *
     * @return Response
     */
    public function store(CreateActivityRequest $request)
    {
        $input = $request->all();

        $loan = Loan::with('activities')->find($request->loan_id);
        $clients_percents = json_decode($loan->client_percents);

        $clientIds = [];

        foreach ($clients_percents as $key => $client) {
            $client->earning_amount = (($client->percent * $request->earnings) / 100);
            //clients Ids
            array_push($clientIds, $client->id);
        }

        $input['client_earnings'] = json_encode($clients_percents);

        //verificar si la suma de sus actividades da el monto total
        $total_amount_activities = $loan->activities->sum('amount') + $input['amount'];

        if($total_amount_activities >= $loan->amount)
        {
          $loan->update(['finished' => true]);
        }

        $activity = $this->activityRepository->create($input);

        //Email owner and clients
        //$clientEmails = User::whereIn('id', $clientIds)->pluck('email');

        //Mail::to('noresponder@tobankgo.tk')
        //->bcc($clientEmails->toArray())
        //->send(new ActivityCreated($activity));

        Flash::success('Activity saved successfully.');

        return redirect(route('activities.index'));
    }

    /**
     * Display the specified Activity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $activity = $this->activityRepository->find($id);
        $this->authorize('view', $activity);

        if (empty($activity)) {
            Flash::error('Activity not found');

            return redirect(route('activities.index'));
        }

        return view('activities.show')->with('activity', $activity);
    }

    /**
     * Show the form for editing the specified Activity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $activity = $this->activityRepository->find($id);

        if (empty($activity)) {
            Flash::error('Activity not found');

            return redirect(route('activities.index'));
        }

        $loans = Loan::with('activities', 'user')->get();

        $activities = ActivityType::pluck('name', 'id');

        return view('activities.edit', compact('activity', 'loans', 'activities'));
    }

    /**
     * Update the specified Activity in storage.
     *
     * @param  int              $id
     * @param UpdateActivityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivityRequest $request)
    {
        $activity = $this->activityRepository->find($id);

        if (empty($activity)) {
            Flash::error('Activity not found');

            return redirect(route('activities.index'));
        }

        $input = $request->all();

        //Calculating earnings
        $loan = Loan::with('activities')->find($request->loan_id);
        $clients_percents = json_decode($loan->client_percents);

        foreach ($clients_percents as $key => $client) {
            $client->earning_amount = (($client->percent * $request->earnings) / 100);
        }

        $input['client_earnings'] = json_encode($clients_percents);
        //Fin earnings

        //verificar si la suma de sus actividades da el monto total
        $total_amount_activities = $loan->activities->sum('amount') + $input['amount'];

        if($total_amount_activities == $loan->amount)
        {
          $loan->update(['finished' => true]);
        }

        $this->activityRepository->update($input, $id);

        Flash::success('Activity updated successfully.');

        return redirect(route('activities.index'));
    }

    /**
     * Remove the specified Activity from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $activity = $this->activityRepository->find($id);

        if (empty($activity)) {
            Flash::error('Activity not found');

            return redirect(route('activities.index'));
        }

        $this->activityRepository->delete($id);

        Flash::success('Activity deleted successfully.');

        return redirect(route('activities.index'));
    }
}
