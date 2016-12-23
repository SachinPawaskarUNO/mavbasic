<?php

/**
 * User Model
 *
 * @category   User
 * @package    MavBasic-Models
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;

use App\Http\Traits\SettingsTrait;
use App\Http\Traits\AuditsTrait;
use Log;


/**
 * Class User
 * @package App
 * @author  Sachin Pawaskar<spawaskar@unomaha.edu>
 * @since   File available since Release 1.0.0
 */
class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    use SoftDeletes { SoftDeletes::restore insteadof EntrustUserTrait; }
    use SettingsTrait;
    use AuditsTrait;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'last_login_at', 'expiration_at', 'password_change_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active', 'phone', 'default_language', 'default_country', 'last_login_ip_address',
        'last_login_device', 'number_of_logins', 'last_login_at', 'expiration_at', 'password_change_at',
        'created_by', 'updated_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get a List of roles ids associated with the current user.
     *
     * @return array
     */
    public function getRoleListAttribute()
    {
        return $this->roles->pluck('id')->all();
    }

    /**
     * Return true if the User has an Administration Role, false otherwise
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Return true if the User has an Administration Role, false otherwise
     *
     * @return bool
     */
    public function isAdministrator()
    {
        return $this->isAdmin();
    }

    /**
     * Return true if the User has an sysadmin Role, false otherwise
     *
     * @return bool
     */
    public function isSystemAdmin()
    {
        return $this->hasRole('sysadmin');
    }

    /**
     * Return true if the User has an sysadmin Role, false otherwise
     *
     * @return bool
     */
    public function isSystem()
    {
        return $this->isSysAdmin();
    }

    /**
     * Return true if the User is Active, false otherwise
     *
     * @return mixed
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Get all of the settings for this user.
     */
    public function settings()
    {
        return $this->belongsToMany('App\Setting', 'setting_user', 'user_id', 'setting_id')
            ->withPivot('user_id', 'setting_id', 'value', 'json_values', 'created_by', 'updated_by')
            ->withTimestamps();
    }

    /**
     * Get all of the eulas for this user.
     */
    public function eulas()
    {
        return $this->belongsToMany('App\Eula', 'eula_user', 'user_id', 'eula_id')
            ->withPivot('user_id', 'eula_id', 'signature', 'accepted_at', 'created_by', 'updated_by')
            ->withTimestamps();
    }

    public function getLatestEula()
    {
        return $this->eulas()->orderBy('pivot_accepted_at', 'desc')->get();
    }

}
