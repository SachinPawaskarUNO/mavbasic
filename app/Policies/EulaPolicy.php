<?php

namespace App\Policies;

/**
 * Eula Policy
 *
 * @category   Eula
 * @package    MavBasic-Policies
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

use App\User;
use App\Eula;
use Illuminate\Auth\Access\HandlesAuthorization;

class EulaPolicy
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

    /**
     * If you may wish to authorize all actions within a given policy for certain users.
     * The before method will be executed before any other methods on the policy,
     * giving you an opportunity to authorize the action before the intended
     * policy method is actually called. This feature is most commonly used
     * for authorizing application administrators to perform any action.
     *
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if ($user->isSystemAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the org.
     *
     * @param  \App\User  $user
     * @param  \App\Org  $org
     * @return mixed
     */
    public function view(User $user, Org $eula)
    {
        if ($user->ability('admin', 'manage-eulas,view-eulas')) {
            if($user->org->id === $eula->org->id) {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create orgs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->ability('admin', 'manage-eulas,create-eulas')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the org.
     *
     * @param  \App\User  $user
     * @param  \App\Org  $org
     * @return mixed
     */
    public function update(User $user, Org $eula)
    {
        if ($user->ability('admin', 'manage-eulas,edit-eulas')) {
            if($user->org->id === $eula->org->id) {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the org.
     *
     * @param  \App\User  $user
     * @param  \App\Org  $org
     * @return mixed
     */
    public function destroy(User $user, Org $eula)
    {
        if ($user->ability('admin', 'manage-eulas,delete-eulas')) {
            if($user->org->id === $eula->org->id) {
                return true;
            }
        } else {
            return false;
        }
    }
}
