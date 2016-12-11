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
        $audits = Audit::all();
        $this->viewData['heading'] = "Audit Activities";
        $this->viewData['audits'] = $audits;

        return view('audits.index', $this->viewData);
    }
}
