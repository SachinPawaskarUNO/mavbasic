<?php

/**
 * Audits Controller
 *
 * @category   Audits
 * @package    MavBasic-Controllers
 * @author     Sachin Pawaskar <spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Http\Controllers;

use App\Audit;
use Illuminate\Http\Request;
use App\Http\Requests\AuditRequest;

use Auth;
use Session;
use Log;

class AuditsController extends Controller
{
    public function __construct()
    {
        $this->middleware('ability:sysadmin, manage-audit|view-audit');

        $this->user = Auth::user();
        $this->heading = "Audits";

        $this->viewData = [ 'user' => $this->user, 'heading' => $this->heading ];
    }

    public function index()
    {
        Log::info('AuditsController.index: ');
        $audits = Audit::orderBy('created_at', 'desc')->get();
        $this->viewData['audits'] = $audits;
        $this->viewData['heading'] = "Audit Activities";

        return view('audits.index', $this->viewData);
    }

    public function show(Audit $audit)
    {
        $object = $audit;
        Log::info('AuditsController.show: '.$object->id);
        $this->viewData['audit'] = $object;
        $this->viewData['heading'] = "View Audit: ".$object->model. ' ['. $object->auditable_id. ']';

        return view('audits.show', $this->viewData);
    }

    /**
     * Restore the given audit record Model/Object.
     *
     * @param  Request  $request
     * @param  Audit  $audit
     * @return Response
     */
    public function restore(Request $request, Audit $audit)
    {
        $object = $audit;
        Log::info('AuditsController.restore: Start: '.$object->id);
        if ($this->authorize('restore', $object))
        {
            $namespacedModel = $object->auditable_type;
            Log::info('Authorization successful: Restoring Model='. $namespacedModel .' ['.$object->auditable_id.']');
            $namespacedModel::withTrashed()->where('id', $object->auditable_id)->restore();
        }
        Log::info('AuditsController.restore: End: ');
        return redirect('/audits');
    }

}
