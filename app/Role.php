<?php

/**
 * Role Model
 *
 * @category   Role
 * @package    Mav-Models
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends EntrustRole
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
    protected $fillable = [
        'org_id', 'name', 'display_name', 'description', 'created_by', 'updated_by'
    ];

    /**
     * Get a List of permission ids associated with the current role.
     *
     * @return array
     */
    public function getPermissionListAttribute()
    {
        return $this->perms->pluck('id')->all();
    }

    /**
     * Get the org that this role belongs to.
     */
    public function org()
    {
        return $this->belongsTo('App\Org');
    }

    /**
     * Scope a query to only include users of a given org.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $org
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfOrg($query, $org)
    {
        return $query->where('org_id', $org->id);
    }
}