<?php

/**
 * Eulas Controller
 *
 * @category   Eulas
 * @package    MavBasic-Controllers
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\EulaRequest;
use App\Eula;
use Auth;
use Session;
use Input;
use DB;
use Log;

class EulasController extends Controller
{
    public function __construct()
    {
        $this->middleware('ability:sysadmin|admin, manage-eulas|create-eulas|edit-eulas|view-eulas|delete-eulas');

        $this->list_eula_status = array('Draft' => 'Draft', 'Active' => 'Active');
        $this->eulas = Eula::all();
        $this->heading = trans('labels.eulas');

        $this->viewData = [ 'eulas' => $this->eulas, 'list_eula_status' => $this->list_eula_status, 'heading' => $this->heading ];
    }

    public function index()
    {
        Log::info('EulasController.index: ');
        if ($this->isSystemAdmin()) {
            $eulas = Eula::all();
        } else {
            $eulas = Eula::ofOrg($this->getLoginUser()->org)->get();
        }
        $this->viewData['eulas'] = $eulas;
        $this->viewData['heading'] = trans('labels.eulas');

        return view('eulas.index', $this->viewData);
    }

    public function show(Eula $eula)
    {
        $object = $eula;
        Log::info('EulasController.show: '.$object->id);
        $this->viewData['eula'] = $object;
        $this->viewData['heading'] = trans('labels.view_eula', ['name' => $object->version]);

        return view('eulas.show', $this->viewData);
    }

    public function create()
    {
        Log::info('EulasController.create: ');
        $this->viewData['heading'] = trans('labels.new_eula');

        return view('eulas.create', $this->viewData);
    }

    public function store(Request $request)
    {
        Log::info('EulasController.store - Start: ');
        if ($this->authorize('create', Eula::class)) {
            Log::info('Authorization successful');
            $input = $request->all();
            $this->populateCreateFieldsWithOrgID($input);

            $object = Eula::create($input);
            Session::flash('flash_message', trans('messages.success_new_eula'));
            Log::info('EulasController.store - End: ' . $object->id);
            return redirect()->back();
        }
    }

    public function edit(Eula $eula)
    {
        $object = $eula;
        Log::info('EulasController.edit: '.$object->id);
        $this->viewData['eula'] = $object;
        $this->viewData['heading'] = trans('labels.edit_eula', ['name' => $object->version]);

        return view('eulas.edit', $this->viewData);
    }

    public function update(Eula $eula, EulaRequest $request)
    {
        $object = $eula;
        Log::info('EulasController.update - Start: '.$object->id);
        if ($this->authorize('update', $object)) {
            Log::info('Authorization successful');

            $this->populateUpdateFields($request);
            if ($request['status'] === 'Active') {
                // If a new eula is made active then make previous Active EULA inactive (in that Org).
                $eulas = Eula::ofOrg($this->getLoginUser()->org)->get();
                $previous_eula = $eulas->where('status', '=', 'Active')->first();
                if ($previous_eula != null) {
                    $previous_eula->status = 'InActive';
                    $previous_eula->save();
                }

                // update the effective date for eula which being updated to Active
                $request['effective_at'] = Carbon::now();
            }

            $object->update($request->all());
            Session::flash('flash_message', trans('messages.success_edit_eula'));
            Log::info('EulasController.update - End: ' . $object->id);
            return redirect('eulas');
        }
    }

    /**
     * Destroy the given eula.
     *
     * @param  Request  $request
     * @param  Eula  $eula
     * @return Response
     */
    public function destroy(Request $request, Eula $eula)
    {
        $object = $eula;
        Log::info('EulasController.destroy: Start: '.$object->id);
        if ($this->authorize('destroy', $object))
        {
            Log::info('Authorization successful');
            $object->delete();
            Log::info('EulasController.destroy: End: ');
            return redirect('/eulas');
        }
    }
}
