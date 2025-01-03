<?php

namespace App\Policies;

use App\User;
use App\Models\Activity;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

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
     * @param  \App\Models\Activity  $activity
     * @return mixed
     */
    public function view(User $user, Activity $activity)
    {

       return $user->id === $activity->loan->user_id;
    }
}
