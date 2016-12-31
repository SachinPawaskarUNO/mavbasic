<?php

namespace App\Policies;

/**
 * User Policy
 *
 * @category   User
 * @package    MavBasic-Policies
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * @param  \App\User  $userRecord
     * @return mixed
     */
    public function view(User $user, User $userRecord)
    {
        if ($user->ability('admin', 'manage-users,view-users')) {
            if($user->org->id === $userRecord->org->id) {
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
        if ($user->ability('admin', 'manage-users,create-users')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the org.
     *
     * @param  \App\User  $user
     * @param  \App\User  $userRecord
     * @return mixed
     */
    public function update(User $user, User $userRecord)
    {
        if ($user->ability('admin', 'manage-users,edit-users')) {
            if($user->org->id === $userRecord->org->id) {
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
     * @param  \App\User  $userRecord
     * @return mixed
     */
    public function delete(User $user, User $userRecord)
    {
        if ($user->ability('admin', 'manage-users,delete-users')) {
            if($user->org->id === $userRecord->org->id) {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can updateSettings (multiple settings) for the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $userRecord
     * @return mixed
     */
    public function updateSettings(User $user, User $userRecord)
    {
        if($user->id === $userRecord->id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can updateSetting (single setting) for the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $userRecord
     * @return mixed
     */
    public function updateSetting(User $user, User $userRecord)
    {
        if($user->id === $userRecord->id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can acceptEula for the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $userRecord
     * @return mixed
     */
    public function acceptEula(User $user, User $userRecord)
    {
        if($user->id === $userRecord->id) {
            return true;
        } else {
            return false;
        }
    }
}

