<?php

namespace App\Observers;

use App\Models\User;

class AgentObserver
{
    public $afterCommit = true;
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        if ($user->isAgent) {
            $user->accountNumber = 'ALG' . $this->generateAccountNumber();
            $user->save();
        }
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
    protected function generateAccountNumber()
    {
        $latest = User::selectRaw('REPLACE(accountNumber,"ALG","") as latest')->where('accountNumber', '<>', null)->orderBy('id', 'desc')->first();

        return (int)$latest->latest + 1;
    }
}
