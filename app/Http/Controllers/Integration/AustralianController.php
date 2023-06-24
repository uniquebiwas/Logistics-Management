<?php

namespace App\Http\Controllers\Integration;

use App\Actions\Australia\AustralianHandler;
use App\Http\Controllers\Controller;
use App\Http\Resources\IndividualOrderResource;
use App\Models\Agent\ShipmentPackage;
use App\Models\OrderImport;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AustralianController extends Controller
{
    public function __construct(AustralianHandler $handler)
    {
        $this->package = $handler->getQuery();
    }
    public function index(Request $request)
    {
        $shipments =  $this->package
            ->latest()
            ->when(request('imported')  == 'notImported', fn ($query) => $query->whereDoesntHave('orderImport'))
            ->when(request('imported') == 'imported', fn ($query) => $query->wherehas('orderImport'))
            ->when($request->startDate, fn ($query) => $query->whereBetween('shipment_date', [request('startDate'), request('endDate')  ?? now()]))
            ->when(request('keyword'), fn ($query) => $query->where('awb_number', 'like', "%" . request('keyword') . "%"))
            ->paginate(request('limit') ?? 50)
            ->appends($request->all());

        $title = "Australian Integration";
        return view('admin.australianIntegrator.index', compact('shipments', 'title'));
    }

    public function store(Request $request)
    {
        $shipment = ShipmentPackage::with('getItems')
            ->where('id', request('shipment'))
            ->doesntHave('orderImport')
            ->get();
        $response =  (new AustralianHandler())->sendOrder($shipment);
        if (!Arr::flatten($response)[1] ?? false) {
            request()->session()->flash('error', Arr::flatten($response)[3]);
            return redirect()->back();
        };
        DB::beginTransaction();
        try {
            OrderImport::Insert($shipment->map(fn ($shipments) => [
                'shipmentId' => $shipments->id,
                'pool_id' => Arr::flatten($response)[2],
                'vendor' => $shipments->service_agent,
                'status' => 1,
                'created_at' => now(),
            ])
                ->toArray());
            DB::commit();
            request()->session()->flash('success', 'Packages Updated Successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            (new AustralianHandler())->deleteOrder($shipment);
            request()->session()->flash('errror', $th->getMessage());
            return redirect()->back();
        }
    }



    public function checkStatus(Request $request, $id)
    {
        $shipment =  OrderImport::with('shipment')
            ->findorfail($id);
        $quickAllocation = (new  AustralianHandler())->checkStatus($shipment);
        return redirect()->back();
    }

    public function quickAllocation(Request $request, $id)
    {
        $shipment =  OrderImport::with('shipment')
            ->findorfail($id);
        $quickAllocation = (new  AustralianHandler())->quickAllocation($shipment->pool_id);
        if (!$quickAllocation == 200) {
            request()->session()->flash('error', 'Allocation cannot be done at the moment');
            return redirect()->back();
        }
        $shipment->update(['allocated' => true]);
        request()->session()->flash('success', 'Allocation done successfully');
        return redirect()->back();
    }

    public function deletePool(Request  $request, $id)
    {
        $shipment =  OrderImport::with('shipment')
            ->findorfail($id);

        $responseData =  (new AustralianHandler())->deleteOrder($shipment);

        if (!$responseData) {
            request()->session()->flash('error', 'Package not found in external system');
            return redirect()->back();
        }

        try {
            $shipment->delete();
            request()->session()->flash('success', 'Packages deleted  Successfully from the system');
            return redirect()->back();
        } catch (\Throwable $th) {
            request()->session()->flash('errror', $th->getMessage());
            return redirect()->back();
        }
    }

    public function getLabel($id)
    {

        $shipment =  OrderImport::with('shipment')
            ->findorfail($id);

        if ($shipment->status != 3) {
            request()->session()->flash('errror', 'order not dispatched yet');
            return redirect()->back();
        }

        return (new AustralianHandler())->checkLabel($shipment);
    }
}
