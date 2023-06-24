<?php

namespace App\Providers;

use App\Events\NewsTagCountEvent;
use App\Events\ShipmentItemsCreated;
use App\Events\ShipmentPackageCreated;
use App\Events\UpdateCredit;
use App\Listeners\CreateUniqueAwbNumber;
use App\Listeners\FacebookPostListner;
use App\Listeners\NewsTagCountListener;
use App\Listeners\ShipmentBarcodeMaker;
use App\Listeners\SubtractCredit;
use App\Models\Agent\ShipmentPackage;
use App\Models\AppSetting;
use App\Models\Invoice;
use App\Models\ShipmentItems;
use App\Models\User;
use App\Observers\AgentObserver;
use App\Observers\AppsettingObserver;
use App\Observers\InvoiceObserver;
use App\Observers\ShipmentPackageObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewsTagCountEvent::class => [
            NewsTagCountListener::class
        ],


        ShipmentItemsCreated::class => [
            ShipmentBarcodeMaker::class,
        ],

        ShipmentPackageCreated::class => [
            CreateUniqueAwbNumber::class,
        ],
        UpdateCredit::class => [
            SubtractCredit::class,
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(AgentObserver::class);
        AppSetting::observe(AppsettingObserver::class);
        Invoice::observe(InvoiceObserver::class);
    }
}
