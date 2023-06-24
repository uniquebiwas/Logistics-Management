<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Agent\ShipmentPackage;
use App\Models\Menu;
use App\Models\ShipmentLocation;
use App\Models\ZoneCountryServiceAgent;
use Illuminate\Http\Request;
use App\Models\Pricing;
use App\Models\WeightPrice;
use App\Traits\Shared\AdminSharedTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClientSearchController extends Controller
{
    use AdminSharedTrait;

    public function search(Request $request)
    {
        $this->validate($request, ['tracking_id' => 'required|exists:shipment_packages,barcode']);
        $package =  ShipmentPackage::where('barcode', $request->tracking_id)->firstorfail();
        $pagedata =  Menu::where('slug', 'tracking')->first();
        if (!$package->tracking_code) {
            $shipmentLocation = ShipmentLocation::with('country')->where('shipmentId', $package->id)
                ->latest('date')
                ->get()
                ->groupBy(function ($data) {
                    return $data->date->format('Y-m-d');
                });
            return view('website.pages.tracking', compact('package', 'pagedata', 'shipmentLocation'));
        }
        $package->load('getServiceAgent:title,id,api_url');
        $url = $this->getUrlList($package->getServiceAgent->api_url, $package->tracking_code);
        return redirect()->away($url);
    }

    protected function getUrlList($title, $tracking_code)
    {
        return $title . '' . $tracking_code;
    }

    public function searchPrice(Request $request)
    {

        try {
            $zone = ZoneCountryServiceAgent::where('serviceagent_id', $request->integrator)->where('country_id', $request->to)->first();

            if (!$zone) {
                return response()->json([
                    'status' => false,
                    'message' => ['Destination country doesnot belong to any zone for this integrator']
                ], 404);
            }
            $price = $this->getPrice($request->integrator, $zone->zone_id, $request->weight,2);
            if (!$price) {
                return response()->json([
                    'status' => false,
                    'message' => ['Price could not be fetched, please contact to our customer service']
                ], 404);
            }
            return response()->json([
                'status' => true,
                'price' => $price,
                'weight' => $request->weight,
                'message' => ['Price fetched successfully']
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => [$e->getMessage()]
            ], 502);
        }
    }

}
