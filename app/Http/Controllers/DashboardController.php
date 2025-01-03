<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Loan;
use App\Models\Activity;
use Illuminate\Support\Arr;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin')->except(['resume', 'summary']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resume()
    {
        $id = auth()->user()->id;

        if (auth()->user()->role != 'user') {
            $user_count = User::count();

            //Total saved
            $total_withdrawals = Withdrawal::sum('amount');
            $total_deposits = Deposit::sum('amount');
            $total_saved = $total_deposits - $total_withdrawals;

            //Total borrowed
            $total_loans = Loan::sum('amount');
            $total_activities = Activity::sum('amount');
            $total_borrowed = $total_loans - $total_activities;

            //Number of active loans
            $total_loans_count = Loan::where('finished', false)->count();

            //Bank account without earnings
            $total_bank_account = $total_saved - $total_borrowed;

            //Earnings
            $earnings = Activity::where('paid', false)->sum('earnings');

            //Loans who endorse
            $endorses = Loan::where('client_id', $id)->where('finished', false)->with('activities')->get();
        }

        //Personal information

        $user_loans = Loan::where('user_id', $id)->where('finished', false)->with('activities')->get();

        //Amount of loans
        $total_loans = $user_loans->sum('amount');

        //Paid
        $total_activities = $user_loans->sum(function ($loan) {
            return $loan->activities->sum('amount');
        });

        //Remaining
        $remaining = $total_loans - $total_activities;

        //Number of active loans
        $total_user_loans_count = Loan::where('user_id', $id)->where('finished', false)->count();

        if (auth()->user()->role != 'user') {
            return view('dashboard.resume', compact('user_count', 'total_saved', 'total_borrowed', 'total_loans_count', 'total_user_loans_count', 'total_bank_account', 'remaining', 'total_loans', 'earnings', 'endorses'));

        } else {
            return view('dashboard.resume', compact('total_loans', 'total_user_loans_count', 'remaining'));
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function payment()
    {
        $activities = Activity::select('client_earnings')->where('paid', false)->get();

        $payments = [];

        foreach ($activities as $activity){

            foreach (json_decode($activity->client_earnings) as $client){

                if(isset($payments[$client->id])) {
                    $payments[$client->id] = [
                        'id' => $client->id,
                        'name' => $client->name,
                        'earning_amount' => round($client->earning_amount + $payments[$client->id]['earning_amount'], 0, PHP_ROUND_HALF_DOWN),
                    ];
                }else{
                    $payments[$client->id] = [
                        'id' => $client->id,
                        'name' => $client->name,
                        'earning_amount' => $client->earning_amount,
                    ];
                }

            }

        }

        $payments = array_reverse(array_values(Arr::sort($payments, function ($value) {
            return $value['earning_amount'];
        })));


        return view('dashboard.payment', compact('payments'));

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payAllPendingActivities()
    {

        //auth()->user()->company->users()->with('loans.activities')->get();
        $count = Activity::max('paid_count');

        Activity::where('paid', 0)->update([
          'paid' => 1,
          'paid_count' => $count + 1,
          'paid_at' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect()->route('dashboard.payment');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pending_users()
    {
        $from = Carbon::now()->startOfMonth()->subDay()->toDateString();
        $to = Carbon::now()->endOfMonth()->addDay()->toDateString();
        $first_month = Carbon::now()->subMonth()->toDateString();

        $loans = Loan::where('created_at', '<=', $first_month)
              ->where('finished', false)->with('user', 'client', 'activities')->orderBy('date', 'Asc')->get();

        $loans = $loans->filter(function ($loan) use ($from, $to) {

            $activities = $loan->activities->whereBetween('date', [$from, $to]);

            return count($activities) == 0;
        });

        return view('dashboard.pending_users', compact('loans'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function summary()
    {
      $user = auth()->user();

      $loans = Loan::where('loans.created_at', '>=', $user->created_at)
          ->has('activities')
          ->with(['activities'  => function($query){
            return $query->where('paid', 0);
          }])->orderBy('loans.created_at', 'DESC')->get();

        return view('dashboard.summary', compact('loans'));
    }
}
