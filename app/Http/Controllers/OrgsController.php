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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\OrgRequest;

use App\Http\Requests;
use App\Org;
use App\Setting;
use Auth;
use Session;
use Log;
use DB;


class OrgsController extends Controller
{
    public function __construct()
    {
        $this->middleware('ability:sysadmin|admin, manage-orgs|create-orgs|edit-orgs|view-orgs|delete-orgs');

        $this->user = Auth::user();
        $this->heading = trans('labels.orgs');

        $this->viewData = [ 'user' => $this->user, 'heading' => $this->heading ];
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

    public function showSettings(Org $org)
    {
        $object = $org;
        Log::info('OrgsController.settings: '.$object->id);
        $this->viewData['org'] = $object;
        $this->viewData['the_org_settings'] = Setting::all()->where('type', '!=', 'system');
        $this->viewData['heading'] = trans('labels.edit_org_settings', ['name' => $object->name]);

        return view('orgs.settings', $this->viewData);
    }

    public function updateSettings(Org $org, Request $request)
    {
        $object = $org;
        Log::info('OrgsController.updateSettings - Start: '.$object->id);
        foreach (Input::get('orgsettings', array()) as $orgsetting)
        {
            $name = $orgsetting['name'];
            $value = $orgsetting['value'] == '' ? $orgsetting['default_value'] : $orgsetting['value'];
            if ($orgsetting['kind'] == 'bool' && $orgsetting['value'] == '') {
                $value = false;
            }

            try{
                $org->setSetting($name, $value);
                Log::info('Org setting updated: '.$name. ' with value '.$value);
            } catch(Exception $e){
                Log::error('OrgsController.updateSettings - Error: '.'Updating org setting'.$name);
                return redirect('orgs.settings')->withErrors(trans('messages.error_edit_org_setting', ['name' => $name]));
            }
        }
        Session::flash('flash_message', trans('messages.success_edit_org_settings'));
        Log::info('OrgsController.updateSettings - End: '.$object->id);
        return back()->withInput();
    }
}
