<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $company;

    public function recalculateTotalAmountAndPercents()
    {
        $users = User::whereIn('role', ['admin', 'client'])
        ->with('deposits', 'withdrawals')
        ->get();

        $total_deposits = Deposit::sum('amount');

        $total_withdrawals = Withdrawal::sum('amount');
        $total_amount = $total_deposits - $total_withdrawals;

        foreach ($users as $user) {

          $total_user_deposits = $user->deposits->sum('amount');
          $total_user_withdrawals = $user->withdrawals->sum('amount');

          $total_user_amount = $total_user_deposits - $total_user_withdrawals;

          $user->total_amount = $total_user_amount;
          $user->percent = ($total_user_amount * 100) / $total_amount;
          $user->save();
        }
    }
}
