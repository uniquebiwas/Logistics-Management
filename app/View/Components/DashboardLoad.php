<?php

namespace App\View\Components;

use App\Models\Agent\ShipmentPackage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class DashboardLoad extends Component
{
    public $reportingDate;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->reportingDate = request('requiredDate') ? Carbon::parse(request('requiredDate'))->format('Y-m-d') : now()->format('Y-m-d');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard-load')
            ->with('todayData', $this->getTodayLoadData())
            ->with('shipments', $this->todayShipments());
    }
    public function getTodayLoadData()
    {
        return DB::table('shipment_packages')
            ->rightJoin('load_shipments', 'load_shipments.shipmentId', 'shipment_packages.id')
            ->join('loads', 'load_shipments.loadId', 'loads.id')
            ->selectRaw('count(*) as total_awb,sum(shipment_packages.total_chargeable_weight) as weight,sum(shipment_packages.totalPiece) as totalPiece')
            ->whereDate('loads.loadDate', $this->reportingDate)
            ->first();
    }

    public function todayShipments()
    {
        return ShipmentPackage::query()
            ->latest('shipment_packages.id')
            ->select('shipment_packages.*')
            ->join('load_shipments', 'load_shipments.shipmentId', 'shipment_packages.id')
            ->whereDate('load_shipments.created_at', $this->reportingDate)
            ->paginate(20)
            ->appends(request()->all());
    }
}
