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
     * Indicates that this Model should stop audit
     *
     * @var bool
     */
    protected static $stopAudit = false;

    /**
     * Indicates the process that is requesting that this Model stop audit
     *
     * @var string
     */
    protected static $stopAuditProcess = "";

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
        if (self::$stopAudit)
        {
            Log::info('AuditsTrait.auditActivity: Audit Stopped [process='.self::$stopAuditProcess.'][object='.get_class($this).'][id='.$this->id.'][user='.Auth::id().']');
            return;
        }

        Log::info('AuditsTrait.auditActivity: [object='.get_class($this).'][event='.$event.'][id='.$this->id.'][user='.Auth::id().']');
       // dd([$event]);

        Audit::create([
            'auditable_id' => $this->id,
            'auditable_type' => get_class($this),
            'activity' => $event,
//             'before' =>($this->fresh()->toJson()),
            'before' => json_encode(array_intersect_key($this->getOriginal(), $this->getDirty())),
            'after'  => json_encode($this->getDirty()),
            'user_id' => Auth::id(),
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
        return "{$action}-{$name}";
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

    public static function stopAudit($process)
    {
        if (empty($process))
            return;
        else {
            self::$stopAudit = true;
            self::$stopAuditProcess = $process;
        }
    }

    public static function startAudit()
    {
        self::$stopAudit = false;
    }

}