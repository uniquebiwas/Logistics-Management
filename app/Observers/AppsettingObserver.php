<?php

namespace App\Observers;

use App\Models\AppSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class AppsettingObserver
{
    /**
     * Handle the AppSetting "created" event.
     *
     * @param  \App\Models\AppSetting  $appSetting
     * @return void
     */
    public function created(AppSetting $appSetting)
    {
        //
    }

    /**
     * Handle the AppSetting "updated" event.
     *
     * @param  \App\Models\AppSetting  $appSetting
     * @return void
     */
    public function updated(AppSetting $appSetting)
    {
        $columns =  Schema::getColumnListing('app_settings');
        $settings = AppSetting::latest()->first();
        foreach ($columns as $key => $setting) {
            Config::set('settings.' . $setting, $settings[$setting]);
        }
    }

    /**
     * Handle the AppSetting "deleted" event.
     *
     * @param  \App\Models\AppSetting  $appSetting
     * @return void
     */
    public function deleted(AppSetting $appSetting)
    {
        //
    }

    /**
     * Handle the AppSetting "restored" event.
     *
     * @param  \App\Models\AppSetting  $appSetting
     * @return void
     */
    public function restored(AppSetting $appSetting)
    {
        //
    }

    /**
     * Handle the AppSetting "force deleted" event.
     *
     * @param  \App\Models\AppSetting  $appSetting
     * @return void
     */
    public function forceDeleted(AppSetting $appSetting)
    {
        //
    }
}
