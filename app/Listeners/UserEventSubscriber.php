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
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen('Illuminate\Auth\Events\Login', 'App\Listeners\UserEventSubscriber@onUserLogin');
        $events->listen('Illuminate\Auth\Events\Logout', 'App\Listeners\UserEventSubscriber@onUserLogout');
    }

}
