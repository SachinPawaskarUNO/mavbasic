<?php

namespace App\Policies;

/**
 * Setting Policy
 *
 * @category   Setting
 * @package    MavBasic-Policies
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

use App\User;
use App\Setting;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
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
     * Determine if the given user can delete the given setting.
     *
     * @param  User  $user
     * @param  Setting  $setting
     * @return bool
     */
    public function destroy(User $user, Setting $setting)
    {
        return $user->isSystemAdmin();
    }
}
