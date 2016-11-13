<?php

/**
 * Roles Controller
 *
 * @category   Roles
 * @package    FA-Controllers
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;

use App\Http\Requests;
use Auth;
use Session;
use Log;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('ability:sysadmin|admin, manage-roles|create-roles|edit-roles|view-roles|delete-roles');

        $this->user = Auth::user();
        $this->list_permission = Permission::pluck('display_name', 'id');
        $this->heading = "Roles";

        $this->viewData = [ 'user' => $this->user, 'list_permission' => $this->list_permission, 'heading' => $this->heading ];
    }

    public function index()
    {
        Log::info('RolesController.index: ');
        $roles = Role::all()->except([1]);  // except the "sysadmin" role.
        $this->viewData['roles'] = $roles;

        return view('roles.index', $this->viewData);
    }

    public function show(Role $role)
    {
        $object = $role;
        Log::info('RolesController.show: '.$object->id);
        $this->viewData['role'] = $object;
        $this->viewData['heading'] = "View Role: ".$object->name;

        return view('roles.show', $this->viewData);
    }

    public function create()
    {
        Log::info('RolesController.create: ');
        $this->viewData['heading'] = "New Role";

        return view('roles.create', $this->viewData);
    }

    public function store(RoleRequest $request)
    {
        Log::info('RolesController.store - Start: ');
        $input = $request->all();
        $this->populateCreateFields($input);

        $object = Role::create($input);
        $this->syncPermissions($object, $request->input('permissionlist'));
        Session::flash('flash_message', 'Role successfully added!');
        Log::info('RolesController.store - End: '.$object->id);
        return redirect()->back();
    }

    public function edit(Role $role)
    {
        $object = $role;
        Log::info('RolesController.edit: '.$object->id);
        $this->viewData['role'] = $object;
        $this->viewData['heading'] = "Edit Role: ".$object->name;

        return view('roles.edit', $this->viewData);
    }

    public function update(Role $role, RoleRequest $request)
    {
        $object = $role;
        Log::info('RolesController.update - Start: '.$object->id);
        $this->populateUpdateFields($request);

        $object->update($request->all());
        $this->syncPermissions($object, $request->input('permissionlist'));
        Session::flash('flash_message', 'Role successfully updated!');
        Log::info('RolesController.update - End: '.$object->id);
        return redirect('roles');
    }

    /**
     * Destroy the given skeletal element.
     *
     * @param  Request  $request
     * @param  Role  $role
     * @return Response
     */
    public function destroy(Request $request, Role $role)
    {
        $object = $role;
        Log::info('RolesController.destroy: Start: '.$object->id);
        if ($this->authorize('destroy', $object))
        {
            Log::info('Authorization successful');
            $object->delete();
        }
        Log::info('RolesController.destroy: End: ');
        return redirect('/roles');
    }

    /**
     * Sync up the list of permissions for the given role record.
     *
     * @param  User  $role
     * @param  array  $permissions (id)
     */
    private function syncPermissions(Role $role, array $permissions)
    {
        Log::info('RolesController.syncPermissions: Start: '.$role->name);
        $role->perms()->sync($this->populateCreateFieldsForSyncWithIDs($permissions, true));
    }
}
