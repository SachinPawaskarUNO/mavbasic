<?php

/**
 * StopWatch Utility
 * A very light weight stop watch.
 *
 * Usage:
 *      StopWatch::start();
 *      sleep(5); // perform some long running operation
 *      echo sprintf("Operation completed in %s seconds", StopWatch::elapsed());
 *
 * If you want a more sophisticated one, use the symfony/stopwatch
 *      Install it via Composer (symfony/stopwatch on Packagist);
 *      Use the official Git repository (https://github.com/symfony/stopwatch).
 *
 * @category   StopWatch
 * @package    Utility
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Utility;


class StopWatch
{
    /**
     * @var $start float The start time of the StopWatch
     */
    private static $startTimes = array();

    /**
     * Start the timer
     *
     * @param $timerName string The name of the timer
     * @return void
     */
    public static function start($timerName = 'default-timer')
    {
        self::$startTimes[$timerName] = microtime(true);
    }

    /**
     * Get the elapsed time in seconds
     *
     * @param $timerName string The name of the timer to start
     * @return float The elapsed time since start() was called
     */
    public static function elapsed($timerName = 'default-timer')
    {
        return microtime(true) - self::$startTimes[$timerName];
    }

    /**
     * Clear all the timers
     *
     * @param none
     * @return void
     */
    public static function clearTimers()
    {
        self::$startTimes[] = array();
    }

}