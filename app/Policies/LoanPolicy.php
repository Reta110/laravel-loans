<?php

namespace App\Policies;

use App\User;
use App\Models\Loan;
use Illuminate\Auth\Access\HandlesAuthorization;

class LoanPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'admin' || $user->role == 'client') {
            return true;
        }
    }

    /**
     * Determine whether the user can view the models loan.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Loan  $loan
     * @return mixed
     */
    public function view(User $user, Loan $loan)
    {

      return $user->id === $loan->user_id;

    }
}
