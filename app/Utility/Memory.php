<?php

/**
 * Memory Utility
 *
 * @category   Memory
 * @package    Utility
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Utility;


class Memory
{
    /**
     * @var $start float The start time of the StopWatch
     */
    private static $collect = false;

    /**
     * set collect flag
     *
     * @param $flag boolean, if true = force the garbage collector to run, default is false
     * @return void
     */
    public static function setCollect($flag)
    {
        self::$collect = $flag;
    }
    /**
     * Dump memory usage
     *
     * @param $collect boolean, if true = force the garbage collector to run, default is false
     * @return void
     */
    public static function dump_usage($collect = false)
    {
        echo "Memory Usage\n";
        echo "memory_get_usage: ".(memory_get_usage()/1024/1024)." MB\n";
        echo "memory_get_peak_usage (not real): ".(memory_get_peak_usage(false)/1024/1024)." MB\n";
        echo "memory_get_peak_usage (real): ".(memory_get_peak_usage(true)/1024/1024)." MB\n\n";
        if ($collect)
        {
            gc_enable();
            gc_collect_cycles();
        }
    }

    /**
     * Collect unused memory
     *
     * @param none
     * @return void
     */
    public static function collect()
    {
        gc_enable();
        gc_collect_cycles();
    }

    /**
     * get memory usage
     *
     * @param none
     * @return float
     */
    public static function getUsage()
    {
        return (memory_get_usage()/1024/1024); // usage in MB
    }

    /**
     * get peak memory usage
     *
     * @param $real boolean, get real/actual usage
     * @return float
     */
    public static function getPeakUsage($real = true)
    {
        return (memory_get_peak_usage($real)/1024/1024); // usage in MB
    }
}