<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use Throwable;
use Carbon\Carbon;
use App\Models\Loan;
use App\Models\User;
use App\Models\Activity;
use App\Models\ActivityType;
use App\Mail\ApproveActivityCreated;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApproveActivityApproved;
use App\Mail\ApproveActivityRegistered;
use App\DataTables\ApproveActivityDataTable;
use App\Http\Requests\UpdateActivityRequest;
use App\Repositories\ApproveActivityRepository;
use App\Http\Requests\CreateApproveActivityRequest;

class ApproveActivityController extends AppBaseController
{
    /** @var  ApproveActivityRepository */
    private $approveActivityRepository;

    public function __construct(ApproveActivityRepository $activityRepo)
    {
        $this->middleware('isAdmin')->only(['edit', 'show', 'update']);
        $this->approveActivityRepository = $activityRepo;
    }

    /**
     * Display a listing of the Activity.
     *
     * @param ApproveActivityDataTable $approveActivityDataTable
     * @return Response
     */
    public function index(ApproveActivityDataTable $approveActivityDataTable)
    {
        return $approveActivityDataTable->render('approve_activities.index');
    }

    /**
     * Show the form for creating a new Activity.
     *
     * @return Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;

        $loans = Loan::with('activities', 'user')
            ->where('finished', false)
            ->where('client_id', $user_id)
            ->orWhere(function ($query) use ($user_id) {
                $query->where('finished', false)
                    ->where('user_id', $user_id);
            })
            ->get();

        $activities = ActivityType::pluck('name', 'id');

        return view('approve_activities.create', compact('loans', 'activities'));
    }

    /**
     * Store a newly created Activity in storage.
     *
     * @param CreateApproveActivityRequest $request
     *
     * @return Response
     */
    public function store(CreateApproveActivityRequest $request)
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

        if ($total_amount_activities >= $loan->amount) {
            $loan->update(['finished' => true]);
        }

        $activity = $this->approveActivityRepository->create($input);

        //Email client (aval) 
        try {
            Mail::to($loan->client->email)
            ->send(new ApproveActivityCreated($activity));
        } catch (Throwable $e) {
            //report($e);
            return false;
        }

        try {
            Mail::to('rafaeltorrealba6@gmail.com')
            ->send(new ApproveActivityRegistered($activity));
        } catch (Throwable $e) {
            //report($e);
            return false;
        }

        Flash::success('Activity for aprrove saved successfully.');

        return redirect(route('approve-activities.index'));
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
        $activity = $this->approveActivityRepository->find($id);

        if (empty($activity)) {
            Flash::error('Approve activity not found');

            return redirect(route('approve-activities.index'));
        }

        return view('approve_activities.show')->with('activity', $activity);
    }

    public function edit($id)
    {
        $approveActivity = $this->approveActivityRepository->find($id);

        if (empty($approveActivity)) {
            Flash::error('Approve activity not found');

            return redirect(route('approve-activities.index'));
        }

        //copiar
        $activity = new Activity;
        $activity->fill($approveActivity->toArray());
        $activity->amount = intval($activity->amount);
        $activity->earnings = intval($activity->earnings);
        $activity->date = Carbon::parse($activity->date)->format('Y-m-d');


        if ($activity->save()) {
            //si todo bien -> borrar el de aprobación
            $approveActivity->update([
                'approved_at' => Carbon::now()->toDateTimeString()
            ]);
            $approveActivity->delete();

            Mail::to('rafaeltorrealba6@gmail.com')
                ->send(new ApproveActivityApproved($activity));
        }

        return redirect(route('approve-activities.index'));
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
        $activity = $this->approveActivityRepository->find($id);

        if (empty($activity)) {
            Flash::error('Activity not foundqwe');

            return redirect(route('approve-activities.index'));
        }

        $this->approveActivityRepository->delete($id);

        Flash::success('Aprove activity deleted successfully.');

        return redirect(route('approve-activities.index'));
    }
}
