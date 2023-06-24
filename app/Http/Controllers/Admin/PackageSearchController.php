<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent\ShipmentPackage;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PackageSearchController extends Controller
{

    public function index(Request $request)
    {
        $data = ShipmentPackage::when($request->startDate, function ($query) use ($request) {
            $query->whereDate('created_at', '>=', $request->startDate);
        })
            ->when($request->endDate, function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->endDate);
            })
            ->when($request->searchShipmentKeyword, function ($query) use ($request) {
                $query->where(fn ($whereQuery) => [$whereQuery->where('barcode', 'like', "%$request->searchShipmentKeyword%")
                    ->orWhere('billing_account', 'like', "%$request->searchShipmentKeyword%")]);
            })
            ->when($request->selectedShipment, function ($query) use ($request) {
                $query->whereNotIn('id', $request->selectedShipment);
            })
            ->when($request->manifestType, function ($query) use ($request) {
                $query->where($request->manifestType, 0);
            })
            ->when($request->manifest, function ($query) {
                $query->where('manifest', 0);
            })
            ->when($request->service_agent, function ($query) use ($request) {
                $query->where('service_agent', $request->service_agent);
            })
            ->when($request->nationalManifest, function ($query) {
                $query->where('nationalManifest', 0)
                    ->whereHas('shipmentLocation', function ($query) {
                        return $query->where('extra_status', 'like', '%alg warehouse%');
                    });
            })
            ->when($request->agentId, function ($query) use ($request) {
                $query->where('agentId', $request->agentId);
            })
            ->when($request->invoice, function ($query) use ($request) {
                $query->where('invoice', false);
            })
            ->when($request->received, function ($query) use ($request) {
                $query->where('package_status', 'RECEIVED');
            })
            ->with('getServiceAgent:id,title')
            ->latest()
            ->get();

        $remarks = $request->remarks;
        $rates = $request->rates;
        $weights = $request->weights;
        $invoiceType = $request->invoice;
        $particularType = Invoice::PARTICULAR;
        $amounts = $request->amounts;

        $view = view('admin.invoice.shipmentData', compact('data', 'remarks', 'rates', 'weights', 'particularType', 'invoiceType', 'amounts'))->render();

        return $view;
    }

    public function searchShipment(Request $request)
    {
        $data = ShipmentPackage::when($request->startDate, function ($query) use ($request) {
            $query->whereDate('created_at', '>=', $request->startDate);
        })
            ->when($request->endDate, function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->endDate);
            })
            ->when($request->searchShipmentKeyword, function ($query) use ($request) {
                $query->where('barcode', 'like', "%$request->searchShipmentKeyword%");
            })
            ->with(['getItems' => function ($query) {
                return $query->where('isBagged', 0);
            }])
            ->whereHas('getItems', function ($query) {
                $query->where('isBagged', 0);
            })
            ->latest()
            ->get();

        $view = view('admin.invoice.shipmentDatawithItem', compact('data'))->render();

        return $view;
    }
}
