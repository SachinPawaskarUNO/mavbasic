<?php

/**
 * User Event Subscriber
 *
 * @category   UserEventSubscriber
 * @package    MavBasic-Subscriber
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Events\SettingChanged;
use App\Events\SettingsChanged;
use App\User;
use Log;

/**
 * Class UserEventSubscriber
 * @package App\Listeners
 */
class UserEventSubscriber
{
    /**
     * UserEventSubscriber constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle user login events.
     * @param $event
     */
    public function onUserLogin($event)
    {
        if (Auth::check())
        {
            $user = Auth::user();
            $user->number_of_logins += 1;
            $user->last_login_at = Carbon::now();
            $user->last_login_ip_address = $this->request->ip();
            $user->last_login_device = $this->request->header('User-Agent');
            $user->save();
        }
    }

    /**
     * Handle user logout events.
     * @param $event
     */
    public function onUserLogout($event)
    {

    }

    /**
     * Handle the setting change events.
     * This is for single settings.
     *
     * @param  SettingChanged  $event
     * @return void
     */
    public function onSettingChange(SettingChanged $event)
    {
        // Special processing for certain user setting should go here.
        if ($event->setting->name === 'welcome_screen_on_startup') {
            $setting = $event->setting;
            $model = $event->model;

            if ($model->getMorphClass() === 'App\User') {
                Log::info('UserEventSubscriber.onSettingChange: Setting-Name='.$setting->name. ' User Id=' .$model->id);
                $this->onSettingChangeForUser($model);
            }
        }
    }

    public function onSettingChangeForUser(User $user) {
        $user->onSettingChange();
    }

    /**
     * Handle the setting change events.
     * This is for multiple settings. Typically on user of org settings save.
     *
     * @param  SettingChanged  $event
     * @return void
     */
    public function onSettingsChange(SettingsChanged $event)
    {
        // Special processing for certain user setting should go here.
        $model = $event->model;

        if ($model->getMorphClass() === 'App\User') {
            Log::info('UserEventSubscriber.onSettingsChange (Multiple): User Id=' .$model->id);
            $this->onSettingChangeForUser($model);
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param - Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen('Illuminate\Auth\Events\Login', 'App\Listeners\UserEventSubscriber@onUserLogin');
        $events->listen('Illuminate\Auth\Events\Logout', 'App\Listeners\UserEventSubscriber@onUserLogout');
        $events->listen('App\Events\SettingChanged', 'App\Listeners\UserEventSubscriber@onSettingChange');
        $events->listen('App\Events\SettingsChanged', 'App\Listeners\UserEventSubscriber@onSettingsChange');
    }

}
