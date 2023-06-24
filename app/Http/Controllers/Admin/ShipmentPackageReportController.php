<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manifest;
use App\Models\Agent\ShipmentPackage;
use DB;

class ShipmentPackageReportController extends Controller {
    public function addNationalManifest() {
        return view( 'admin.shipmentpackage.national-form' );
    }

    public function nationalManifest( Request $request ) {
        return view( 'admin.shipmentpackage.national' );
    }

    public function invoice( Request $request ) {
        return view( 'admin.shipmentpackage.invoice' );
    }
}
