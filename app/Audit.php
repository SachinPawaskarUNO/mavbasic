<?php

/**
 * Audit Model
 *
 * @category   Audit
 * @package    MavBasic-Models
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

/**
 * Class User
 * @package App
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @since      File available since Release 1.0.0
 */
class Audit extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'auditable_id', 'auditable_type', 'activity', 'before', 'after', 'user_id'
    ];

    /**
     * Get all of the owning auditable models.
     */
    public function auditable()
    {
        return $this->morphTo();
    }

    /**
     * Get the user responsible for the given audit activity.
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}