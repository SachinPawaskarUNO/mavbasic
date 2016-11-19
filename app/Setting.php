<?php

/**
 * Setting Model
 *
 * @category   Setting
 * @package    Basic-Models
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'help', 'default_value', 'kind', 'display_type', 'display_values',
        'created_by', 'updated_by',];

    /**
     * Get all of the users that are assigned this setting.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'setting_user', 'setting_id', 'user_id')
            ->withPivot('user_id', 'setting_id', 'value', 'created_by', 'updated_by')
            ->withTimestamps();
    }
}
