<?php

namespace App\Observers;

use App\Models\Agent\ShipmentPackage;
use Mail;

class ShipmentPackageObserver
 {
    public $afterCommit = true;

    /**
    * Handle the ShipmentPackage 'created' event.
    *
    * @param  \App\Models\Agent\ShipmentPackage  $shipmentPackage
    * @return void
    */

    public function created( ShipmentPackage $shipmentPackage )
 {
       
    }

    /**
    * Handle the ShipmentPackage 'updated' event.
    *
    * @param  \App\Models\Agent\ShipmentPackage  $shipmentPackage
    * @return void
    */

    public function updated( ShipmentPackage $shipmentPackage )
 {
        //
    }

    /**
    * Handle the ShipmentPackage 'deleted' event.
    *
    * @param  \App\Models\Agent\ShipmentPackage  $shipmentPackage
    * @return void
    */

    public function deleted( ShipmentPackage $shipmentPackage )
 {
        //
    }

    /**
    * Handle the ShipmentPackage 'restored' event.
    *
    * @param  \App\Models\Agent\ShipmentPackage  $shipmentPackage
    * @return void
    */

    public function restored( ShipmentPackage $shipmentPackage )
 {
        //
    }

    /**
    * Handle the ShipmentPackage 'force deleted' event.
    *
    * @param  \App\Models\Agent\ShipmentPackage  $shipmentPackage
    * @return void
    */

    public function forceDeleted( ShipmentPackage $shipmentPackage )
 {
        //
    }
}
