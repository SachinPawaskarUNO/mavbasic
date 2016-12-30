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

use App\Events\SettingChanged;
use App\Setting;
use Auth;
use Cache;
use Log;

trait SettingsTrait {

    // get setting value
    public function getSettingValue($name)
    {
        $setting = $this->settings()->where(['settingable_id' => $this->id, 'settingable_type' => $this->getMorphClass(), 'name' => $name])->first();
        if ($setting) {
            return $this->stringToKind($setting, $setting->pivot->value);
        } else {
            return $this->getSettingDefaultValue($name);
        }
    }

    // get setting default value
    public function getSettingDefaultValue($name)
    {
        $setting = Setting::where(['name' => $name])->first();
        if ($setting) {
            return $this->stringToKind($setting, $setting->default_value);
        } else { // Should never get here unless developer is asking for a setting not defined in the System
            return null;
        }
    }

    // get setting display values
    public function getSettingDisplayValues($name)
    {
        $setting = Setting::where(['name' => $name])->first();
        if ($setting) {
            if ($setting->kind == 'object' || $setting->kind == 'model') {
                // example {"model":"App\\User", "field":"name", "whereCol":"name", "whereOp":"!=", "whereValue":"System"}
                // example {"model":"App\\User", "field":"name"}
                $opts = json_decode($setting->display_values, true);
                $namedModel = array_has($opts, 'model') ? $opts['model'] : null;
                $field = array_has($opts, 'field') ? $opts['field'] : null;
                $whereCol = array_has($opts, 'whereCol') ? $opts['whereCol'] : null;
                if (!empty($whereCol)) {
                    $whereOp = array_has($opts, 'whereOp') ? $opts['whereOp'] : null;
                    $whereValue = array_has($opts, 'whereValue') ? $opts['whereValue'] : null;
                    return $namedModel::where($whereCol, $whereOp, $whereValue)->pluck($field, 'id');
                } else {
                    return $namedModel::pluck($field, 'id');
                }
            } else {
                return $setting->display_values;
            }
        } else { // Should never get here unless developer is asking for a setting not defined in the System
            return null;
        }
    }

    // get setting min value
    public function getSettingValueMin($name)
    {
        $setting = Setting::where(['name' => $name])->first();
        if ($setting) {
            $opts = json_decode($setting->display_values, true);
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
            $opts = json_decode($setting->display_values, true);
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
            $opts = json_decode($setting->display_values, true);
            return array_has($opts, 'step') ? $opts['step'] : null;
        } else {
            return null;
        }
    }

    // get setting Json values
    public function getSettingJsonValues($name)
    {
        $setting = $this->settings()->where(['settingable_id' => $this->id, 'settingable_type' => $this->getMorphClass(), 'name' => $name])->first();
        if ($setting) {
            return $setting->pivot->json_values;
        } else {
            return null;
        }
    }

    // get setting Json values as an array
    public function getSettingJsonValuesArray($name)
    {
        $json_values = $this->getSettingJsonValues($name);
        if (!empty($json_values)) {
            $values = unserialize($json_values);
            return $values;
        } else {
            return null;
        }
    }

    // get setting Json values as an array
    public function getSettingJsonValuesCount($name)
    {
        $json_values = $this->getSettingJsonValues($name);
        if (!empty($json_values)) {
            $values = unserialize($json_values);
            return count($values);
        } else {
            return 0;
        }
    }

    // get setting
    public function getSetting($name)
    {
        return $this->settings()->where(['settingable_id' => $this->id, 'settingable_type' => $this->getMorphClass(), 'name' => $name])->first();
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

        $record = $this->settings()->where(['settingable_id' => $this->id, 'settingable_type' => $this->getMorphClass(), 'name' => $name])->first();
        if($record)
        {
//            dd($record, $name, $value);
            Log::info('SettingsTrait.storeSettings: Update Existing Pivot: '.$record->name. ' = ' .$value);
            $this->settings()->updateExistingPivot($record->id, ['value' => $value, 'updated_by' => $this->name ]);
        } else {
            $setting = Setting::where(['name' => $name])->first();
            Log::info('SettingsTrait.storeSettings: Save New: '.$setting->name. ' = ' .$value);
            $this->settings()->save($setting, ['value' => $value, 'created_by' => Auth::user()->name, 'updated_by' => Auth::user()->name ]);
            $record = $setting;
        }
        event(new SettingChanged($record, $this));
    }

    // create-update setting
    public function addSettingJsonValue($name, $object)
    {
        $this->storeSettingJsonValue($name, $object);
    }

    private function storeSettingJsonValue($name, $object)
    {
        Log::info('SettingsTrait.storeSettingJsonValue: Start '.$this->name);

        $record = $this->settings()->where(['settingable_id' => $this->id, 'settingable_type' => $this->getMorphClass(), 'name' => $name])->first();
        if($record)
        {
            Log::info('SettingsTrait.storeSettingJsonValue: Update Existing Pivot: '.$record->name. ' = ' .$object->id);
            $json_values = $this->buildSettingJson($record, $object);
            $json_values = (count($json_values) > $record->pivot->value) ? array_slice($json_values, 0, $record->pivot->value) : $json_values;
            $this->settings()->updateExistingPivot($record->id, ['json_values' => serialize($json_values), 'updated_by' => $this->name ]);
        } else {
            $setting = Setting::where(['name' => $name])->first();
            $json_values = $this->buildSettingJson(null, $object);
            Log::info('SettingsTrait.storeSettingJsonValue: Save New: '.$setting->name. ' = ' .$object->id);
            $this->settings()->save($setting, ['value' => $setting->default_value, 'json_values' => serialize($json_values), 'created_by' => Auth::user()->name, 'updated_by' => Auth::user()->name ]);
        }
    }


    private function buildSettingJson($record, $object)
    {
        $values = [];
        if ($record) {
            if (!empty($record->pivot->json_values)) {
                $values = unserialize($record->pivot->json_values);
                $key = array_search($object->id, array_column($values, 'id'));
                if ($key !== false)
                    unset($values[$key]);
            }
        }

        $values = array_prepend($values, ['id' => $object->id, 'name' => $object->name]);
        Log::info('SettingsTrait.buildSettingJson: json_values: ' . serialize($values));
        return $values;
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

    public function stringToKind($setting, $value)
    {
        if ($setting->kind === 'boolean' || $setting->kind === 'bool') {
            return ($value === 'true' || $value === '1') ? true : false;
        } else if ($setting->kind === 'int' || $setting->kind === 'integer') {
            return intval($value);
        } else {
//            Log::info('SettingsTrait.stringToKind: name=' . $setting->name . ' kind=' . $setting->kind . ' value=' . $value);
            return $value;
        }
    }
}