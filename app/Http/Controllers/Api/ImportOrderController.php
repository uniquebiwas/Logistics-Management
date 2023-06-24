<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IndividualOrderResource;
use App\Models\Agent\ShipmentPackage;
use App\Models\OrderImport;
use Illuminate\Http\Request;

class ImportOrderController extends Controller
{
    public function import($count = 1)
    {
        $shipment = ShipmentPackage::inRandomOrder()
            ->with('getItems')
            ->take($count)
            ->doesntHave('orderImport')
            ->get();
        try {
            OrderImport::Insert($shipment->map(fn ($shipments) => [
                'shipmentId' => $shipments->id,
                'vendor' => $shipments->service_agent,
                'created_at' => now(),
            ])
                ->toArray());
            $orders = IndividualOrderResource::collection($shipment);
            return response()->json([
                'orders' => $orders,
                'hash' => $this->makeHash($orders)
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function removeOrder(Request $request)
    {
        $shipment =  OrderImport::with('shipment')
            ->where('shipmentId', $request->id_order)
            ->first();
        if (!$shipment) {
            return response()->json([
                "request_success" => false,
                "request_result" => [],
                "error" => "id_order does not Exist In System"
            ], 401);
        }
        try {
            $shipment->delete();
            return response()->json([
                "request_success" => true,
                "request_result"  => [
                    "id_order_removed" => $shipment->shipment->barcode,
                    "id_platform_removed" => "1",
                    "id_pool_removed" => $shipment->shipment->id,
                    "timestamp_removed" => $shipment->deleted_at,
                ],
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    private function makeHash($orders)
    {
        return hash('md5', base64_encode(json_encode($orders)));
    }
}
