<?php

/**
 * Users Controller
 *
 * @category   Users
 * @package    MavBasic-Controllers
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Http\Controllers;

use App\Events\SettingsChanged;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Scopes\OrgScope;
use App\Events\EulaAccepted;
use App\User;
use App\Role;
use App\Setting;
use App\Eula;
use Auth;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use Log;

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('ability:sysadmin|admin, manage-users|create-users|edit-users|view-users|delete-users');

        $this->list_role = Role::pluck('display_name', 'id');
        $this->viewData = [ 'list_role' => $this->list_role];
    }

    public function index()
    {
        Log::info('UsersController.index: ');
        if ($this->isSystemAdmin()) {
            $users = User::withoutGlobalScope(OrgScope::class)->get()->except([1]); // except the "System" User
        } else {
            $users = User::ofOrg($this->getLoginUser()->org)->get();
        }
        $this->viewData['users'] = $users;
        $this->viewData['heading'] = trans('labels.users');

        return view('users.index', $this->viewData);
    }

    public function show(User $user)
    {
        $object = $user;
        Log::info('UsersController.show: '.$object->id);
        $this->viewData['user'] = $object;
        $this->viewData['heading'] = trans('labels.view_user', ['name' => $object->name]);

        Auth::user()->addSettingJsonValue('mru_list_users', $object);
        return view('users.show', $this->viewData);
    }

    public function create()
    {
        Log::info('UsersController.create: ');
        $this->viewData['heading'] = trans('labels.new_user');

        return view('users.create', $this->viewData);
    }

    public function store(UserRequest $request)
    {
        Log::info('UsersController.store - Start: ');
        if ($this->authorize('create', User::class)) {
            Log::info('Authorization successful');

            $input = $request->all();
            $this->populateCreateFieldsWithOrgID($input);
            $input['password'] = bcrypt($request['password']);
            $input['active'] = $request['active'] == '' ? false : true;

            $object = User::create($input);
            $this->syncRoles($object, $request->input('rolelist'));
            Session::flash('flash_message', trans('messages.success_new_user'));
            Log::info('UsersController.store - End: ' . $object->id);

            return redirect()->back();
        }
    }

    public function edit(User $user)
    {
        $object = $user;
        Log::info('UsersController.edit: '.$object->id);
        $this->viewData['user'] = $object;
        $this->viewData['heading'] = trans('labels.edit_user', ['name' => $object->name]);
        if (!Auth::user()->hasRole('sysadmin')) {
            $this->viewData['list_role'] = Role::all()->except(1)->pluck('display_name', 'id');
        }

        return view('users.edit', $this->viewData);
    }

    public function update(User $user, UserRequest $request)
    {
        $object = $user;
        Log::info('UsersController.update - Start: '.$object->id);
        if ($this->authorize('update', $object)) {
            Log::info('Authorization successful');

            $this->populateUpdateFields($request);
            $request['active'] = $request['active'] == '' ? false : true;

            $object->update($request->all());
            $this->syncRoles($object, $request->input('rolelist'));
            Session::flash('flash_message', trans('messages.success_edit_user'));
            Log::info('UsersController.update - End: ' . $object->id);
            return redirect('users');
        }
    }

    /**
     * Destroy the given user.
     *
     * @param  Request  $request
     * @param  User  $user
     * @return Response
     */
    public function destroy(Request $request, User $user)
    {
        $object = $user;
        Log::info('UsersController.destroy: Start: '.$object->id);
        if ($this->authorize('destroy', $object))
        {
            Log::info('Authorization successful');
            $object->delete();
            Log::info('UsersController.destroy: End: ');
            return redirect('/users');
        }
    }

    /**
     * Sync up the list of roles for the given user record.
     *
     * @param  User  $user
     * @param  array  $roles (id)
     */
    private function syncRoles(User $user, array $roles)
    {
        Log::info('UsersController.syncRoles: Start: '.$user->name);
        $user->roles()->sync($this->populateCreateFieldsForSyncWithIDs($roles, true));
    }

    public function showSettings(User $user)
    {
        $object = $user;
        Log::info('UsersController.showSettings: '.$object->id);
        $this->viewData['user'] = $object;
        $this->viewData['the_user_settings'] = Setting::all()->where('type', '=', 'user');
        $this->viewData['heading'] = trans('labels.edit_user_settings', ['name' => $object->name]);

        return view('users.settings', $this->viewData);
    }

    public function updateSettings(User $user, Request $request)
    {
        $object = $user;
        Log::info('UsersController.updateSettings - Start: '.$object->id);
        if ($this->authorize('updateSettings', $object)) {
            Log::info('Authorization successful');

            $user->setFireSettingChanged(false);
            $fireSettingsChanged = false;
            foreach (Input::get('usersettings', array()) as $usersetting) {
                $name = $usersetting['name'];
                $value = $usersetting['value'] == '' ? $usersetting['default_value'] : $usersetting['value'];
                if ($usersetting['kind'] == 'bool' && $usersetting['value'] == '') {
                    $value = false;
                }

                try {
                    $user->setSetting($name, $value);
                    $fireSettingsChanged = true;
                    Log::info('User setting updated: ' . $name . ' with value ' . $value);
                } catch (Exception $e) {
                    Log::error('UsersController.updateSettings - Error: ' . 'Updating user setting' . $name);
                    return redirect('users.settings')->withErrors(trans('messages.error_edit_user_setting', ['name' => $name]));
                }
            }
            $user->setFireSettingChanged(true);
            Session::flash('flash_message', trans('messages.success_edit_user_settings'));
            Log::info('UsersController.updateSettings - End: ' . $object->id);
            if ($fireSettingsChanged) {
                event(new SettingsChanged($user));
            }
            return back()->withInput();
        }
    }

    public function acceptEula(User $user, Request $request)
    {
        $object = $user;
        Log::info('UsersController.acceptEula: '.$object->id);
        if ($this->authorize('acceptEula', $object)) {
            Log::info('Authorization successful');

            $accept = $request['accept'];
            Log::info('UsersController.acceptEula: accept=' . $accept);
            if ($accept) {
                Log::info('UsersController.acceptEula: accept=success');
                // Check user language/country and make sure that it matches the language/country for the latest system EULA.
                $eula = $user->org->getActiveEulaForUser($user);
                $user->eulas()->save($eula, ['accepted_at' => Carbon::now(), 'created_by' => $user->name, 'updated_by' => $user->name]);
                $response = json_encode(array('success' => '1', 'msg' => trans('messages.success_eula_accepted') . ' - ' . trans('labels.thank_you')));

                event(new EulaAccepted($eula, $user));
            } else {
                $response = json_encode(array('success' => '0', 'msg' => trans('messages.error_eula_accepted')));
            }

            return $response;
        }
    }

    public function updateSetting(User $user, Request $request)
    {
        $object = $user;
        Log::info('UsersController.updateSetting: '.$object->id);
        if ($this->authorize('updateSetting', $object)) {
            Log::info('Authorization successful');

            $value = $request['settingvalue'];
            $settingname = $request['settingname'];
            Log::info('UsersController.updateSetting: ' . '[' . $settingname . '=' . $value . ']');
            $user->setSetting($settingname, $value);
            //        $response   = array('success' => '0', 'error' => 'User setting NOT saved');
            $response = json_encode(array('success' => '1', 'msg' => trans('messages.success_edit_user_setting')));
            return $response;
        }
    }
}
