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
