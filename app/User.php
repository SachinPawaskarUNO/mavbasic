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
use App\Eula;
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

    public $wizard = array('mode' => 'false', 'displaytabs' => 'false', 'modal' => 'true', 'heading' => 'Welcome to SPawaskar Wizard');
    public $wizardHelp = array('mode' => 'false', 'displaytabs' => 'true', 'modal' => 'false', 'heading' => 'Application Help Wizard');
    public $wizardTabs = array('Eula' => ['name' => 'Eula', 'active' => true], 'Welcome' => ['name' => 'Welcome', 'active' => false]);
    public $wizardHelpTabs = array('Eula' => ['name' => 'Eula', 'active' => true], 'Welcome' => ['name' => 'Welcome', 'active' => false]);

    // Eula related
    public $eulaAccepted = false;
    public static $eulaActiveSystemList = [];
    public $userAcceptedEula = null;

    public $passwordChangeRequested = false;
    public $showStartupWizard = false;

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

    public function getActiveEula()
    {
        return $this->eulas()->orderBy('pivot_accepted_at', 'desc')->get()->first();
    }

    public function checkEula()
    {
        $systemEula = Eula::getActiveSystemEula($this->default_language, $this->default_country);
        $currentlyAcceptedEula = $this->getActiveEula();

        if (!isset($currentlyAcceptedEula) || !isset($systemEula)) {
//            dd(['true',$systemEula, $currentlyAcceptedEula, $this]);
            return ($this->eulaAccepted = false);
        } else if ($systemEula->id != $currentlyAcceptedEula->id) {
            return ($this->eulaAccepted = false);
        } else {
            return ($this->eulaAccepted = true);
        }
    }

    /**
     * check if wizard should be displayed on startup
     */
    public function buildWizardStartup() {
        $modal = 'true';
        $this->wizardStartup = $this->wizardStartupTabs = [];

        $this->checkEula();

        // ToDo: implement System Eula check in the future. This will be a System/Org setting.
        // First check to see if we need to display EULA
        if (!$this->eulaAccepted) {
            if (Eula::getActiveSystemEula($this->default_language, $this->default_country) != null) {
                $this->wizardStartupTabs = array_merge($this->wizardStartupTabs, array('Eula' => ['name' => 'Eula', 'src' => '\eula']));
            }
        }
        count($this->wizardStartupTabs) ? $modal = 'true' : $modal = 'false'; // which mean we have Eula tab
        $startTab = (count($this->wizardStartupTabs) == 1) ? 'Eula' : ''; // which mean we have Eula tab

        // Second check to see if we need to display Change Password
        if ($this->passwordChangeRequested) {
            $this->wizardStartupTabs = array_merge($this->wizardStartupTabs,
                array('ChangePassword' => ['name' => 'ChangePassword', 'src' => '\passwordChangeOnLogin']));
            if (empty($startTab)) { $startTab = 'ChangePassword'; }
        }

        if ($this->getSettingValue('WelcomeScreenOnStartup'))
        {
            $this->wizardStartupTabs = array_merge($this->wizardStartupTabs,
                array('Welcome' => ['name' => 'Welcome', 'src' => '\help']));
            if (empty($startTab)) { $startTab = 'Welcome'; }
        }

        if (count($this->wizardStartupTabs)) {
            $this->wizardStartup = array('wizardType'=>'Startup', 'mode'=>'false', 'displaytabs'=>'false',
                'startTab'=>$startTab, 'modal'=>$modal, 'heading'=>'Startup: Welcome - '.$this->name);
        }
        $this->showStartupWizard = count($this->wizardStartupTabs) ? true:false;
        Log::info('User.buildWizardStartup: wizardStartupTabs='.json_encode($this->wizardStartupTabs));
        Log::info('User.buildWizardStartup: wizardStartup='.json_encode($this->wizardStartup));
        return count($this->wizardStartupTabs);
    }

    /**
     * check if wizard should be displayed on startup
     */
    public function buildWizardHelp() {
        $this->wizardHelp = $this->wizardHelpTabs = [];

        $this->wizardHelpTabs = array_merge($this->wizardHelpTabs, array('About' => ['name' => 'About', 'src' => '\about']));
        $this->wizardHelpTabs = array_merge($this->wizardHelpTabs, array('AboutBrowser' => ['name' => 'AboutBrowser', 'src' => '\aboutbrowser']));

        if ($this->getSettingValue('WelcomeScreenOnStartup'))
        {
            $this->wizardHelpTabs = array_merge($this->wizardHelpTabs, array('Welcome' => ['name' => 'Welcome', 'src' => '\help']));
        }
        if ($this->eulaAccepted) {
            if (Eula::getActiveSystemEula($this->default_language, $this->default_country) != null) {
                $this->wizardHelpTabs = array_merge($this->wizardHelpTabs, array('Eula' => ['name' => 'Eula', 'src' => '\eula']));
            }
        }

        if (count($this->wizardHelpTabs)) {
            $this->wizardHelp = array('wizardType'=>'Help', 'mode'=>'false', 'displaytabs'=>'true',
                'startTab'=>'About', 'modal'=>'false', 'heading'=>config('app.name', 'MavBasic') . ' - Help');
        }
        Log::info('User.buildWizardHelp: wizardHelpTabs='.json_encode($this->wizardHelpTabs));
        Log::info('User.buildWizardHelp: wizardHelp='.json_encode($this->wizardHelp));
        return count($this->wizardHelpTabs);
    }
}
