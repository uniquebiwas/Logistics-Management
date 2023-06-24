<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent\ShipmentPackage;
use App\Models\ShipmentCharge;
use Barryvdh\DomPDF\Facade  as PDF;
use File;

class PrintLabelController extends Controller {
    //

    public function __construct( ShipmentPackage $shipmentPackage ) {
        $this->shipmentPackage = $shipmentPackage;
    }

    public function printLabel( $id ) {
        $shipmentPackage_info = $this->shipmentPackage->with( 'getAgent', 'getItems', 'getSender', 'getReceiver', 'getCharge' )->find( $id );
        if ( !$shipmentPackage_info ) {
            return response()->json( [
                'success' => 'false',
                'error' => 'Package not found',
                'label' => '',
                'consignment_no' => '',
                'tracking_url' => '',
            ], 404 );
        }
        // dd( $shipmentPackage_info );
        try {

            $charge = new ShipmentCharge();
            view()->share( [ 'package' => $shipmentPackage_info, 'charge' => $charge ] );
            $pdf = PDF::loadView( 'admin/shipmentpackage/label' );
            $pdf->setPaper( 'A4', 'portrait' );

            $path = public_path( 'label' );

            if ( !File::isDirectory( $path ) ) {

                File::makeDirectory( $path, 0777, true, true );

            }
            $pdf->save( 'label/'.$shipmentPackage_info->barcode.'.pdf' );
            $link =  asset( 'label/'.$shipmentPackage_info->barcode.'.pdf' );
            return response()->json( [
                'success' => 'true',
                'error' => '',
                'label' => $link,
                'consignment_no' => $shipmentPackage_info->barcode,
                'tracking_url' => route('clientPackageSearch',['tracking_id'=>'663000']),
            ], 201 );
        } catch ( \Exception $error ) {
            return response()->json( [
                'success' => 'false',
                'error' => $error->getMessage(),
                'label' => '',
                'consignment_no' => '',
                'tracking_url' => '',
            ], 502 );
        }
    }
}
