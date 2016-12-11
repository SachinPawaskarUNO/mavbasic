<?php

/**
 * Audit Request
 *
 * @category   Audit
 * @package    MavBasic-Requests
 * @author     Sachin Pawaskar <spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'auditable_id'      => 'required',
            'auditable_type'    => 'required|min:3',
            'activity'          => 'required|min:3',
            'user_id'           => 'required',
        ];
    }
}
