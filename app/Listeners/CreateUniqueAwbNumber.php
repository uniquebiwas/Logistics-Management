<?php

namespace App\Listeners;

use App\Events\ShipmentPackageCreated;
use App\Models\Agent\ShipmentPackage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUniqueAwbNumber
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
     * @param  ShipmentPackageCreated  $event
     * @return void
     */
    public function handle($event)
    {
        $data = $this->makeAwbNumber();
        $shipmentItems = ShipmentPackage::find($event->items->id);
        $shipmentItems->awb_number = $data;
        $shipmentItems->barcode = $data;
        $shipmentItems->save();
    }

    public function makeAwbNumber()
    {
        $latest = ShipmentPackage::selectRaw('REPLACE(awb_number,"ALG","") as latest')
            ->where('awb_number', '<>', null)
            ->orderBy('id', 'desc')->first();
        if (empty($latest->latest)) {
            return 663000;
        }
        return ((int)$latest->latest + 1);
    }
}
