<?php

/**
 * Audits Trait
 *
 * @category   Audits
 * @package    MavBasic-Traits
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Http\Traits;

use ReflectionClass;
use App\Audit;
use Auth;
use Log;

trait AuditsTrait
{
    /**
     * Register the necessary event listeners.
     *
     * @return void
     */
    protected static function bootAuditsTrait()
    {
        foreach (static::getModelEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->auditActivity($event);
            });
        }
    }

    /**
     * record audit activity for the model.
     *
     * @param  string $event
     * @return void
     */
    public function auditActivity($event)
    {
        Log::info('AuditsTrait.auditActivity: ');
       // dd([$event]);
        $user_id = null;
        if (!empty(Auth::id())) {
            $user_id = Auth::id();
        }
        
        Audit::create([
            'auditable_id' => $this->id,
            'auditable_type' => get_class($this),
            'activity' => $this->getActivityName($this, $event),
//             'before' =>($this->fresh()->toJson()),
            'before' => json_encode(array_intersect_key($this->getOriginal(), $this->getDirty())),
            'after'  => json_encode($this->getDirty()),
            'user_id' => $user_id
        ]);
    }

    /**
     * Prepare the appropriate activity name.
     *
     * @param  mixed  $model
     * @param  string $action
     * @return string
     */
    protected function getActivityName($model, $action)
    {
        $name = strtolower((new ReflectionClass($model))->getShortName());
        return "{$action}_{$name}";
    }

    /**
     * Get the model events to audit.
     *
     * @return array
     */
    protected static function getModelEvents()
    {
        if (isset(static::$auditEvents)) {
            return static::$auditEvents;
        }

        return [ 'created', 'deleted', 'updated' ];
    }
}