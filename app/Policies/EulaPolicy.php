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
     * Determine if the given user can delete the given eula.
     *
     * @param  User  $user
     * @param  Eula  $eula
     * @return bool
     */
    public function destroy(User $user, Eula $eula)
    {
        return $user->isSystemAdmin();
    }
}
