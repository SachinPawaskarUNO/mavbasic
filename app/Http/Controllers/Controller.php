<?php

/**
 * Controller Class derived from BaseController
 *
 * @category   Controller
 * @package    FA-Controllers
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function populateCreateFields(&$input)
    {
        if (Auth::check() && $input != null)
        {
            $input['created_by'] = Auth::user()->name;
            $input['updated_by'] = Auth::user()->name;
        }
    }

    public function populateUpdateFields(&$input)
    {
        if (Auth::check() && $input != null)
        {
            $input['updated_by'] = Auth::user()->name;
        }
    }

    public function populateCreateFieldsWithUserID(&$input)
    {
        $this->populateCreateFields($input);
        if (Auth::check() && $input != null)
        {
            $input['user_id'] = Auth::user()->id;
        }
    }

    public function populateCreateFieldsForSyncWithIDs($arr_ids, $ts = false)
    {
        $syncData = [];
        foreach($arr_ids as $id)
        {
            if (Auth::check())
            {
                if ($ts) {
                    $syncData[$id] = [ 'created_by' => Auth::user()->name, 'updated_by' => Auth::user()->name,
                                       'created_at' => date_create(), 'updated_at' => date_create()];
                } else {
                    $syncData[$id] = [ 'created_by' => Auth::user()->name, 'updated_by' => Auth::user()->name ];
                }
            }
        }
        return $syncData;
    }

    public function populateCreateFieldsForSyncWithData($arr_data, $field, $type = 'string')
    {
        $syncData = [];
        foreach($arr_data as $data)
        {
            if (Auth::check())
            {
                if ($type == 'boolean') {
                    $syncData[$data['id']] = [ $field => true, 'created_by' => Auth::user()->name, 'updated_by' => Auth::user()->name ];
                } else { // assume string - default
                    $syncData[$data['id']] = [ $field => $data[$field], 'created_by' => Auth::user()->name, 'updated_by' => Auth::user()->name ];
                }
            }
        }
        return $syncData;
    }

    public function getArrayCreateFields()
    {
        $input = [];
        if (Auth::check() && $input != null)
        {
            $input['created_by'] = Auth::user()->name;
            $input['updated_by'] = Auth::user()->name;
        }
        return $input;
    }

    public function getLoginUser()
    {
        if (Auth::check()) {
            return Auth::user();
        } else {
            return null;
        }
    }

    public function getLoginUserId()
    {
        if (Auth::check()) {
            return Auth::user()->id;
        } else {
            return 1; // by default return Administrator user id.
        }
    }

    public function getListofIdsFromModelCollection($objects)
    {
        $list = [];
        $count = 0;
        foreach ($objects as $obj) {
            $list[$count++] = $obj->id;
        }
        return $list;
    }

}
