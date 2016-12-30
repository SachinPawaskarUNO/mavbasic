<?php

namespace App\Listeners;

use App\Events\SettingChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Log;
use App\User;
use App\Org;
use App\Setting;

class UserRefresh
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SettingChanged  $event
     * @return void
     */
    public function handle(SettingChanged $event)
    {
        // Special processing for certain user setting should go here.
        if ($event->setting->name === 'welcome_screen_on_startup') {
            $setting = $event->setting;
            $model = $event->model;

            if ($model->getMorphClass() === 'App\User') {
                Log::info('Listener-UserRefresh.handle: Setting-Name='.$setting->name. ' User Id=' .$model->id);
                $this->onSettingChangeForUser($model);
            } else if ($model->getMorphClass() === 'App\Org') {
                Log::info('Listener-UserRefresh.handle: Setting-Name='.$setting->name. ' Org Id=' .$model->id);
                $this->onSettingChangeForOrg($model);
            }
        }
    }

    public function onSettingChangeForUser(User $model) {
        $model->onSettingChange();
    }

    public function onSettingChangeForOrg(Org $model) {
        // Todo: need to implement Org->onSettingChange
        $model->onSettingChange();
    }
}
