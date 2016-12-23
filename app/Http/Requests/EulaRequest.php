<?php

/**
 * Eula Request
 *
 * @category   Eula
 * @package    MavBasic-Requests
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EulaRequest extends FormRequest
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
            'version'       => 'required|min:1',
//            'agreement'     => 'required|min:3',
//            'country'       => 'required|min:2',
//            'language'      => 'required|min:2',

//            'version', 'agreement', 'country', 'language', 'active', 'file_type', 'effective_at',
//            'created_by', 'updated_by',
        ];
    }
}
