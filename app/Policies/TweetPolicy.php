<?php

namespace App\Policies;

use App\Models\Tweet;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class TweetPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Request $name): bool
    {
        return $user->name == $name;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tweet $tweet): bool
    {
        $accept = $user->level == 'admin' || $user->id == $tweet->user_id;
        return $accept;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tweet $tweet): bool
    {
        return $user->id == $tweet->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tweet $tweet): bool
    {
        $accept = $user->level == 'admin' || $user->id == $tweet->user_id;
        return $accept;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tweet $tweet): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tweet $tweet): bool
    {
        //
    }
}
