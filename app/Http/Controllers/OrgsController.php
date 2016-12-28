<?php

/**
 * Orgs Controller
 *
 * @category   Orgs
 * @package    MavBasic-Controllers
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Http\Controllers;

use App\Permission;
use App\Org;
use Illuminate\Http\Request;
use App\Http\Requests\OrgRequest;

use App\Http\Requests;
use Auth;
use Session;
use Log;

class OrgsController extends Controller
{
    public function __construct()
    {
        $this->middleware('ability:sysadmin|admin, manage-orgs|create-orgs|edit-orgs|view-orgs|delete-orgs');

        $this->user = Auth::user();
        $this->list_permission = Permission::pluck('display_name', 'id');
        $this->heading = trans('labels.orgs');

        $this->viewData = [ 'user' => $this->user, 'list_permission' => $this->list_permission, 'heading' => $this->heading ];
    }

    public function index()
    {
        Log::info('OrgsController.index: ');
        $orgs = Org::all();
        $this->viewData['orgs'] = $orgs;
        $this->viewData['heading'] = trans('labels.orgs');

        return view('orgs.index', $this->viewData);
    }

    public function show(Org $org)
    {
        $object = $org;
        Log::info('OrgsController.show: '.$object->id);
        $this->viewData['org'] = $object;
        $this->viewData['heading'] = trans('labels.view_org', ['name' => $object->name]);

        return view('orgs.show', $this->viewData);
    }

    public function create()
    {
        Log::info('OrgsController.create: ');
        $this->viewData['heading'] = trans('labels.new_org');

        return view('orgs.create', $this->viewData);
    }

    public function store(OrgRequest $request)
    {
        Log::info('OrgsController.store - Start: ');
        $input = $request->all();
        $this->populateCreateFields($input);

        $object = Org::create($input);
        $this->syncPermissions($object, $request->input('permissionlist'));
        Session::flash('flash_message', trans('messages.success_new_org'));
        Log::info('OrgsController.store - End: '.$object->id);
        return redirect()->back();
    }

    public function edit(Org $org)
    {
        $object = $org;
        Log::info('OrgsController.edit: '.$object->id);
        $this->viewData['org'] = $object;
        $this->viewData['heading'] = trans('labels.edit_org', ['name' => $object->name]);

        return view('orgs.edit', $this->viewData);
    }

    public function update(Org $org, OrgRequest $request)
    {
        $object = $org;
        Log::info('OrgsController.update - Start: '.$object->id);
        $this->populateUpdateFields($request);

        $object->update($request->all());
        Session::flash('flash_message', trans('messages.success_edit_org'));
        Log::info('OrgsController.update - End: '.$object->id);
        return redirect('orgs');
    }

    /**
     * Destroy the given skeletal element.
     *
     * @param  Request  $request
     * @param  Org  $org
     * @return Response
     */
    public function destroy(Request $request, Org $org)
    {
        $object = $org;
        Log::info('OrgsController.destroy: Start: '.$object->id);
        if ($this->authorize('destroy', $object))
        {
            Log::info('Authorization successful');
            $object->delete();
        }
        Log::info('OrgsController.destroy: End: ');
        return redirect('/orgs');
    }

    /**
     * Sync up the list of permissions for the given org record.
     *
     * @param  User  $org
     * @param  array  $permissions (id)
     */
    private function syncPermissions(Org $org, array $permissions)
    {
        Log::info('OrgsController.syncPermissions: Start: '.$org->name);
        $org->perms()->sync($this->populateCreateFieldsForSyncWithIDs($permissions, true));
    }
}
