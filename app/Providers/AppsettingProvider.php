<?php

namespace App\Providers;

use App\Models\AppSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppsettingProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('settings', function ($app) {
            return new AppSetting();
        });
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Setting', Setting::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!\App::runningInConsole() && count(Schema::getColumnListing('app_settings'))) {
            $columns =  Schema::getColumnListing('app_settings');
            $settings = AppSetting::latest()->first();
            foreach ($columns as $key => $setting) {
                Config::set('settings.' . $setting, $settings[$setting]);
            }
        }
    }
}
