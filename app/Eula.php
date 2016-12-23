<?php

/**
 * Eula Model
 *
 * @category   Eula
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
use Carbon\Carbon;

class Eula extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'effective_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['version', 'agreement', 'country', 'language', 'status', 'file_type', 'effective_at',
        'created_by', 'updated_by',];

    /**
     * @return mixed|string
     */
    public function getLanguageCountryAttribute()
    {
        if (!empty($this->country)) {
            return $this->language .'-'. $this->country;
        } else {
            return $this->language;
        }
    }

    /**
     * @param $value
     * @return null
     */
    public function getEffectiveAtAttribute($value)
    {
        return ($value != "") ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    /**
     * Get all of the users that are assigned this eula.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'eula_user', 'eula_id', 'user_id')
            ->withPivot('user_id', 'eula_id', 'signature', 'accepted_at', 'created_by', 'updated_by')
            ->withTimestamps();
    }
}