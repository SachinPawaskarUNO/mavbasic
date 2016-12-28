<?php

namespace App\Policies;

/**
 * Org Policy
 *
 * @category   Org
 * @package    MavBasic-Policies
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

use App\User;
use App\Org;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrgPolicy
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
     * Determine if the given org can delete the given orgrecord.
     *
     * @param  User  $user
     * @param  Org  $orgrecord
     * @return bool
     */
    public function destroy(User $user, Org $orgrecord)
    {
        return $user->isSystemAdmin();
    }

}

