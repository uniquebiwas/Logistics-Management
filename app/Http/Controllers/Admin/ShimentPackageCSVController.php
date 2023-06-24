<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AwbExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utilities\LogActivity;
use App\Models\Agent\ShipmentPackage;
use App\Exports\ShipmentPackageExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ExportShipmentPackage;
use App\Models\ServiceAgent;
use Illuminate\Support\Facades\DB;

class ShimentPackageCSVController extends Controller
{
    public function __construct(ShipmentPackage $shipmentPackage, ExportShipmentPackage $export)
    {
        $this->shipmentPackage = $shipmentPackage;
        $this->export = $export;
    }
    protected function getShipmentPackage($request, $status = null, $cancelledBy = null)
    {
        $limit = 100;
        if ($request->limit) {
            $limit = $request->limit;
        }

        $query = $this->shipmentPackage
            ->where('export', false)
            ->whereIn('package_status', array_slice($this->shipmentPackage::STATUS, 3));
        if ($status) {
            $query = $query->where('package_status', $status);
        }
        if ($cancelledBy) {
            $query = $query->where('package_status', $status)->where('cancelled_by_type', $cancelledBy);
        }
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('barcode', 'LIKE', '%' . $keyword . '%');
        }
        if ($request->startDate) {

            $query =  $query->whereDate('created_at', '>=', $request->startDate);
        }

        if ($request->service_agent) {
            $query =  $query->where('service_agent', $request->service_agent);
        }
        if ($request->agentId) {
            $query =  $query->where('agentId', $request->agentId);
        }
        if ($request->endDate) {
            $query =  $query->whereDate('created_at', '<=', $request->endDate);
        }
        if (auth()->user()->roles->first()->name == 'Agent') {
            $query =  $query = $query->where('agentId', auth()->id());
        }
        return $query->with('getSender')->orderBy('id', 'DESC')->paginate($limit);
    }
    protected function getExportCSV($request, $status = null, $cancelledBy = null)
    {
        $query = $this->export;

        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', '%' . $keyword . '%');
        }
        if ($request->startDate) {
            $query =  $query->whereDate('created_at', '>=', $request->startDate);
        }

        if ($request->endDate) {
            $query =   $query->whereDate('created_at', '<=', $request->endDate);
        }

        if ($request->service_agent) {
            $query = $query->where('service_agent', $request->service_agent);
        }
        if (auth()->user()->roles->first()->name == 'Agent') {
            $query = $query->where('agentId', auth()->id());
        }
        return $query->orderBy('id', 'DESC')->paginate($request->limit ?? 20);
    }
    public function index(Request $request)
    {
        $title = 'Export CSV';
        $data = $this->getExportCSV($request);
        return view('admin/shipmentpackage/exportList', compact('data', 'title'));
    }
    public function create(Request $request)
    {

        $title = 'Export CSV';
        $data = $this->getShipmentPackage($request);
        $serviceAgent = ServiceAgent::get()->mapWithKeys(
            function ($serviceAgent) {
                return [$serviceAgent->id => $serviceAgent->title];
            }
        );
        $firstServiceAgent = $serviceAgent->keys()->first();
        return view('admin/shipmentpackage/export', compact('data', 'title', 'serviceAgent', 'firstServiceAgent'));
    }
    public function show($id)
    {
        $export_info = $this->export->find($id);
        if (!$export_info) {
            abort(404);
        }
        $title = $export_info->title . ' Detail';
        $shipmentPackage_info = $this->shipmentPackage->whereIn('id', $export_info->shipment_ids ?? [])->get();
        return view('admin/shipmentpackage/exportDetail', compact('shipmentPackage_info', 'title', 'export_info'));
    }
    public function exportShipmentPackage(Request $request)
    {
        $this->validate($request, ['title' => 'required', 'shipment_ids.*' => 'required|exists:shipment_packages,id']);
        $data = [
            'title' => $request->title,
            'shipment_ids' => $request->ids,
        ];
        DB::beginTransaction();
        try {
            ExportShipmentPackage::create($data);
            ShipmentPackage::whereIn('id', $request->ids)->update(['export' => true]);
            $title = DB::table('service_agents')
                ->select('title')
                ->join('shipment_packages', 'shipment_packages.service_agent', 'service_agents.id')
                ->where('shipment_packages.id', $request->ids[0])
                ->first();
            DB::commit();
            $export = new AwbExport(
                $request->ids,
                $title->title
            );


            return Excel::download($export, date('ymdhis') . 'shipmentpackage.csv');
        } catch (\Throwable $th) {
            DB::rollBack();
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function downloadUploading($id)
    {
        $export = ExportShipmentPackage::findorfail($id);

        try {
            $export = new AwbExport(
                $export->shipment_ids ?? [],
            );

            return Excel::download($export, date('ymdhis') . 'shipmentpackage.csv');
        } catch (\Throwable $th) {
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
