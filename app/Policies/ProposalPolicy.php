<?php

namespace App\Policies;

use App\User;
use App\Proposal;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProposalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the proposal.
     *
     * @param  \App\User  $user
     * @param  \App\Proposal  $proposal
     * @return mixed
     */
    public function view(User $user, Proposal $proposal)
    {
        //
    }

    /**
     * Determine whether the user can create proposals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the proposal.
     *
     * @param  \App\User  $user
     * @param  \App\Proposal  $proposal
     * @return mixed
     */
    public function update(User $user, Proposal $proposal)
    {
        return $user->id == $proposal->user_id;
    }

    /**
     * Determine whether the user can delete the proposal.
     *
     * @param  \App\User  $user
     * @param  \App\Proposal  $proposal
     * @return mixed
     */
    public function delete(User $user, Proposal $proposal)
    {
        //
    }
}
