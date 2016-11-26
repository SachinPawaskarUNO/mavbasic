<?php

/**
 * Settings Trait
 *
 * @category   Settings
 * @package    MavBasic-Traits
 * @author     Sachin Pawaskar<spawaskar@unomaha.edu>
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
 */

namespace App\Http\Traits;

use App\Setting;
use Cache;
use Log;

trait SettingsTrait {

    // get setting value
    public function getSettingValue($name)
    {
        $setting = $this->settings()->where(['user_id' => $this->id, 'name' => $name])->first();
        if ($setting) {
            return $setting->pivot->value;
        } else {
            return $this->getSettingDefaultValue($name);
        }
    }

    // get setting default value
    public function getSettingDefaultValue($name)
    {
        $setting = Setting::where(['name' => $name])->first();
        if ($setting) {
            return $setting->default_value;
        } else { // Should never get here unless developer is asking for a setting not defined in the System
            return null;
        }
    }

    // get setting display values
    public function getSettingDisplayValues($name)
    {
        $setting = Setting::where(['name' => $name])->first();
        if ($setting) {
            return $setting->display_values;
        } else { // Should never get here unless developer is asking for a setting not defined in the System
            return null;
        }
    }

    // get setting min value
    public function getSettingValueMin($name)
    {
        $setting = Setting::where(['name' => $name])->first();
        if ($setting) {
            $opts = json_decode($this->getSettingDisplayValues($name), true);
            return array_has($opts, 'min') ? $opts['min'] : null;
        } else {
            return null;
        }
    }

    // get setting max value
    public function getSettingValueMax($name)
    {
        $setting = Setting::where(['name' => $name])->first();
        if ($setting) {
            $opts = json_decode($this->getSettingDisplayValues($name), true);
            return array_has($opts, 'max') ? $opts['max'] : null;
        } else {
            return null;
        }
    }

    // get setting max value
    public function getSettingValueStep($name)
    {
        $setting = Setting::where(['name' => $name])->first();
        if ($setting) {
            $opts = json_decode($this->getSettingDisplayValues($name), true);
            return array_has($opts, 'step') ? $opts['step'] : null;
        } else {
            return null;
        }
    }

    // get setting
    public function getSetting($name)
    {
        return $this->settings()->where(['user_id' => $this->id, 'name' => $name])->first();
//        $settings = $this->getCache();
//        $value = array_get($settings, $name);
//        return ($value !== '') ? $value : NULL;
    }

    // create-update setting
    public function setSetting($name, $value)
    {
        $this->storeSetting($name, $value);
//        $this->setCache();
    }

    // create-update multiple settings at once
    public function setSettings($data = [])
    {
        foreach($data as $name => $value)
        {
            $this->storeSetting($name, $value);
        }
//        $this->setCache();
    }

    private function storeSetting($name, $value)
    {
        Log::info('SettingsTrait.storeSettings: Start '.$this->name);

        $record = $this->settings()->where(['user_id' => $this->id, 'name' => $name])->first();
        if($record)
        {
//            dd($record, $name, $value);
            Log::info('SettingsTrait.storeSettings: Update Existing Pivot: '.$record->name. ' = ' .$value);
            $this->settings()->updateExistingPivot($record->id, ['value' => $value, 'updated_by' => $this->name ]);
        } else {
            $setting = Setting::where(['name' => $name])->first();
            Log::info('SettingsTrait.storeSettings: Save New: '.$setting->name. ' = ' .$value);
            $this->settings()->save($setting, ['value' => $value, 'created_by' => $this->name, 'updated_by' => $this->name ]);
        }
    }

    // ToDo: implement caching for settings at some point.
    private function getCache()
    {
        if (Cache::has('user_settings_' . $this->id))
        {
            return Cache::get('user_settings_' . $this->id);
        }
        return $this->setCache();
    }

    private function setCache()
    {
        if (Cache::has('user_settings_' . $this->id))
        {
            Cache::forget('user_settings_' . $this->id);
        }
        $settings = $this->settings->lists('value','name');
        Cache::forever('user_settings_' . $this->id, $settings);
        return $this->getCache();
    }

}