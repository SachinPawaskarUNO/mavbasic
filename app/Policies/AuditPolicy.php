<?php

namespace App\Policies;

/**
 * Audit Policy
 *
 * @category   Audit
 * @package    MavBasic-Policies
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

use App\User;
use App\Audit;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuditPolicy
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
     * Determine if the given user can restore the given audit record/model.
     *
     * @param  User  $user
     * @param  Audit  $audit
     * @return bool
     */
    public function restore(User $user, Audit $audit)
    {
        return ($user->isSystemAdmin() && $audit->activity == "deleted");
    }
}
