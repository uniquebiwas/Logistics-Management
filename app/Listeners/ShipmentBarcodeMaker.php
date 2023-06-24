<?php

namespace App\Listeners;

use App\Events\ShipmentItemsCreated;
use App\Models\ShipmentItems;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class ShipmentBarcodeMaker
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
     * @param  ShipmentItemsCreated  $event
     * @return void
     */
    public function handle(ShipmentItemsCreated $event)
    {
        $shipmentItems = ShipmentItems::find($event->items->id);
        $shipmentItems->barcode = $this->makeBarcode();
        $shipmentItems->save();
    }

    public function makeBarcode()
    {
        $random =  rand(10000000000, 90000000000);
        if (ShipmentItems::where('barcode', $random)->first()) {
            $this->makeBarcode();
        }
        return $random;
    }
}
