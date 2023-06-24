<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent\ShipmentPackage;
use App\Models\ShipmentLocation;

class TrackingOrderController extends Controller
{

    public function byPassing(Request $request)
    {
        $ids = explode(",", $request->tracking_ids);
        $data = [];
        foreach($ids as $id){
            $package =  ShipmentPackage::where('barcode', $id)->first();
            $events = [];
            $items = [];
                // dd($package->getItems);
            if($package){
                foreach($package->shipmentLocation as $location){
                    $events[] =[
                        'location' => $location->location,
                        'description' => $location->remarks,
                        'date' => $location->created_at,
                    ];
                }
                foreach($package->getItems as $item){
                    $items[] =[
                        'article_id' => $item->barcode,
                        'product_type' => $package->getPackageType->package_type,
                        'events' => $events,
                        'status' => $package->package_status
                    ];
                }


                    $data[]=[
                        'tracking_id' => $id,
                        'trackable_items' => [
                            'consignment_id' => $id,
                            'number_of_items' => count($package->getItems),
                            'items' => $items,
                        ],
                    ];
            }
            else{
                $data[]=[
                    'tracking_id' => $id,
                    'errors' => [
                        'message' => 'Invalid tracking ID',
                    ],
                ];
            }

        }
        return response()->json(['tracking_results' => $data],200);

    }
}
