<?php

/**
 * Users Controller
 *
 * @category   Users
 * @package    FA-Controllers
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use App\Role;
use App\Setting;
use Auth;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use Log;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('ability:sysadmin|admin, manage-users|create-users|edit-users|view-users|delete-users');

        $this->user = Auth::user();
        $this->users = User::all()->except([1]);  // except the "System" User
        $this->list_role = Role::pluck('display_name', 'id');
        $this->heading = "Users";

        $this->viewData = [ 'user' => $this->user, 'users' => $this->users, 'list_role' => $this->list_role, 'heading' => $this->heading ];
    }

    public function index()
    {
        Log::info('UsersController.index: ');
        $users = User::all()->except([1]);  // except the "System" User
        $this->viewData['users'] = $users;

        return view('users.index', $this->viewData);
    }

    public function show(User $user)
    {
        $object = $user;
        Log::info('UsersController.show: '.$object->id);
        $this->viewData['user'] = $object;
        $this->viewData['heading'] = "View User: ".$object->name;

        return view('users.show', $this->viewData);
    }

    public function create()
    {
        Log::info('UsersController.create: ');
        $this->viewData['heading'] = "New User";

        return view('users.create', $this->viewData);
    }

    public function store(UserRequest $request)
    {
        Log::info('UsersController.store - Start: ');
        $input = $request->all();
        $this->populateCreateFields($input);
        $input['password'] = bcrypt($request['password']);
        $input['active'] = $request['active'] == '' ? false : true;

        $object = User::create($input);
        $this->syncRoles($object, $request->input('rolelist'));
        Session::flash('flash_message', 'User successfully added!');
        Log::info('UsersController.store - End: '.$object->id);

        return redirect()->back();
    }

    public function edit(User $user)
    {
        $object = $user;
        Log::info('UsersController.edit: '.$object->id);
        $this->viewData['user'] = $object;
        if (!Auth::user()->hasRole('sysadmin')) {
            $this->viewData['list_role'] = Role::all()->except(1)->pluck('display_name', 'id');
        }

        $this->viewData['heading'] = "Edit User: ".$object->name;

        return view('users.edit', $this->viewData);
    }

    public function update(User $user, UserRequest $request)
    {
        $object = $user;
        Log::info('UsersController.update - Start: '.$object->id);
//        $this->authorize($object);
        $this->populateUpdateFields($request);
        $request['active'] = $request['active'] == '' ? false : true;

        $object->update($request->all());
        $this->syncRoles($object, $request->input('rolelist'));
        Session::flash('flash_message', 'User successfully updated!');
        Log::info('UsersController.update - End: '.$object->id);
        return redirect('users');
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
        }
        Log::info('UsersController.destroy: End: ');
        return redirect('/users');
    }

    public function showSettings(User $user)
    {
        $object = $user;
        Log::info('UsersController.settings: '.$object->id);
        $this->viewData['user'] = $object;
        $this->viewData['the_user_settings'] = Setting::all();
        $this->viewData['heading'] = "Edit User Settings: ".$object->name;

        return view('users.settings', $this->viewData);
    }

    public function updateSettings(User $user, Request $request)
    {
        $object = $user;
        Log::info('UsersController.updateSettings - Start: '.$object->id);
        foreach (Input::get('usersettings', array()) as $usersetting)
        {
            $name = $usersetting['name'];
            $value = $usersetting['value'] == '' ? $usersetting['default_value'] : $usersetting['value'];
            if ($usersetting['kind'] == 'bool' && $usersetting['value'] == '') {
                $value = '0';
            }

            try{
                $user->setSetting($name, $value);
                Log::info('User setting updated: '.$name. ' with value '.$value);
            } catch(Exception $e){
                Log::error('UsersController.updateSettings - Error: '.'Updating user setting'.$name);
                return redirect('users.settings')->withErrors('Error: Updating user setting '.$name );
            }
        }
        Session::flash('flash_message', 'User settings successfully updated!');
        Log::info('UsersController.updateSettings - End: '.$object->id);

        $this->viewData['user'] = $object;
        $this->viewData['the_user_settings'] = Setting::all();
        $this->viewData['heading'] = "Edit User Settings: ".$object->name;

        return view('users.settings', $this->viewData);
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
}
