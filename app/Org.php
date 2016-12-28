<?php

/**
 * Org Model
 *
 * @category   Org
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

class Org extends Model
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
    protected $fillable = ['name', 'address', 'city', 'state', 'zip', 'geo_lat', 'geo_long',
        'website', 'phone', 'toll_free', 'fax', 'contact_name', 'contact_email',
        'created_by', 'updated_by',];

    /**
     * Get the full address, which is concatenation of address, city, state and zip fields.
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        $full_address = $this->address;
        $full_address .= !empty($this->city) ? ', ' . $this->city : "";
        $full_address .= !empty($this->state) ? ', ' . $this->state : "";
        $full_address .= !empty($this->zip) ? ' ' . $this->zip : "";
        return $full_address;
    }

    /**
     * Get all of the users that are assigned this org.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'org_user', 'org_id', 'user_id')
            ->withPivot('user_id', 'org_id', 'created_by', 'updated_by')
            ->withTimestamps();
    }
}
