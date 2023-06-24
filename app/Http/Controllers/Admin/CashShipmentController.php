<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent\ShipmentPackage;
use App\Models\Credit;
use App\Models\ServiceAgent;
use App\Models\ShipmentCharge;
use App\Models\ShipmentPackageType;
use Illuminate\Http\Request;

class CashShipmentController extends Controller
{
    public function index(Request $request)
    {
        $serviceAgents = ServiceAgent::where('publishStatus', 1)->pluck('title', 'id');
        if (Auth()->user()->agent) {
            $remaining_request = Credit::where('agentId', auth()->user()->id)
                ->selectRaw('SUM(creditAmount) as remain')
                ->first();
        }
        $data =  [
            "title" => "Add New Shipment",
            "shipmentPackage_info" => new ShipmentPackage(),
            "packageTypes" => ShipmentPackageType::where('publishStatus', '1')->get()->pluck('package_type', 'id'),
            "serviceAgents" => $serviceAgents,
            "remaining_request" => $remaining_request->remain ?? null,
            "url" => request()->is('agent/shipment*') ? route('shipment.store') : route('shipmentpackage.store'),
            'shipmentCharge' => new ShipmentCharge(),
        ];
        return view('admin/shipmentpackage/cashForm/form', $data);
    }
}
