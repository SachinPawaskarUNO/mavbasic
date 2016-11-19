<?php

/**
 * Settings Controller
 *
 * @category   Settings
 * @package    MavBasic-Controllers
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Role;
use App\Setting;
use Auth;
use Session;
use Input;
use DB;
use Log;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('ability:sysadmin|admin, manage-settings|create-settings|edit-settings|view-settings|delete-settings');

        $this->user = Auth::user();
        $this->settings = Setting::all();
        $this->list_kind = array('string' => 'string', 'int' => 'int', 'bool' => 'bool');
        $this->list_display_type = array('input' => 'input', 'dropdown' => 'dropdown', 'checkbox' => 'checkbox');
        $this->heading = "Settings";

        $this->viewData = [ 'user' => $this->user, 'settings' => $this->settings, 'list_kind' => $this->list_kind,
            'list_display_type' => $this->list_display_type, 'heading' => $this->heading ];
    }

    public function index()
    {
        Log::info('SettingsController.index: ');
        $settings = Setting::all();
        $this->viewData['settings'] = $settings;

        return view('settings.index', $this->viewData);
    }

    public function show(Setting $setting)
    {
        $object = $setting;
        Log::info('SettingsController.show: '.$object->id);
        $this->viewData['setting'] = $object;
        $this->viewData['heading'] = "View Setting: ".$object->name;

        return view('settings.show', $this->viewData);
    }

    public function create()
    {
        Log::info('SettingsController.create: ');
        $this->viewData['heading'] = "New Setting";

        return view('settings.create', $this->viewData);
    }

    public function store(SettingRequest $request)
    {
        Log::info('SettingsController.store - Start: ');
        $input = $request->all();
        $this->populateCreateFields($input);
        $input['password'] = bcrypt($request['password']);
        $input['active'] = $request['active'] == '' ? false : true;

        $object = Setting::create($input);
        Session::flash('flash_message', 'Setting successfully added!');
        Log::info('SettingsController.store - End: '.$object->id);

        return redirect()->back();
    }

    public function edit(Setting $setting)
    {
        $object = $setting;
        Log::info('SettingsController.edit: '.$object->id);
        $this->viewData['setting'] = $object;
        $this->viewData['heading'] = "Edit Setting: ".$object->name;

        return view('settings.edit', $this->viewData);
    }

    public function update(Setting $setting, SettingRequest $request)
    {
        $object = $setting;
        Log::info('SettingsController.update - Start: '.$object->id);
//        $this->authorize($object);
        $this->populateUpdateFields($request);
        $request['active'] = $request['active'] == '' ? false : true;

        $object->update($request->all());
        Session::flash('flash_message', 'Setting successfully updated!');
        Log::info('SettingsController.update - End: '.$object->id);
        return redirect('settings');
    }

    /**
     * Destroy the given setting.
     *
     * @param  Request  $request
     * @param  Setting  $setting
     * @return Response
     */
    public function destroy(Request $request, Setting $setting)
    {
        $object = $setting;
        Log::info('SettingsController.destroy: Start: '.$object->id);
        if ($this->authorize('destroy', $object))
        {
            Log::info('Authorization successful');
            $object->delete();
        }
        Log::info('SettingsController.destroy: End: ');
        return redirect('/settings');
    }
}
