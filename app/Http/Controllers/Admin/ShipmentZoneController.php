<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ServiceAgent;
use App\Models\ShipmentZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pricing;

class ShipmentZoneController extends Controller
{
    public function __construct(ShipmentZone $shipmentZone)
    {
        $this->shipmentZone = $shipmentZone;
        $this->countries = Country::pluck('name', 'id');
    }

    protected function getshipmentZone($request)
    {
        $query = $this->shipmentZone->with('serviceAgent:id,title');
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', '%' . $keyword . '%');
        }
        if ($request->serviceAgentId) {
            $query = $query->where('serviceAgentId',  $request->serviceAgentId);
        }
        return $query->orderBy('serviceAgentId', 'ASC')->paginate(20)->appends(request()->all());
    }
    public function index(Request $request)
    {
        $data = $this->getshipmentZone($request);
        $serviceAgents = ServiceAgent::get()->mapWithKeys(function ($item) {
            return [$item->id => $item->title];
        });
        return view('admin/shipmentzone/list', compact('data', 'serviceAgents'));
    }

    public function create(Request $request)
    {
        $shipmentZone_info = null;
        $countries = $this->countries;
        $serviceAgents = ServiceAgent::get()->mapWithKeys(function ($item) {
            return [$item->id => $item->title];
        });
        $title = 'Add New Shipment Zone';
        return view('admin/shipmentzone/form', compact('shipmentZone_info', 'title', 'countries', 'serviceAgents'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:190',
            'publishStatus' => 'required|in:0,1',
            'serviceAgentId' => 'required|exists:service_agents,id'
        ]);
        $data = [
            'title' => $request->title,
            'publishStatus' => $request->publishStatus,
            'created_by' => Auth::user()->id,
            'serviceAgentId' => $request->serviceAgentId,
            'position' => $request->title,
        ];
        try {
            DB::beginTransaction();
            $shipmentZone = ShipmentZone::create($data);
            $request->session()->flash('success', 'New Shipment Zone added successfully.');
            DB::commit();
            return redirect()->route('shipmentzone.index');
        } catch (\Exception $error) {
            DB::rollBack();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        $shipmentZone_info = $this->shipmentZone->find($id);
        if (!$shipmentZone_info) {
            abort(404);
        }
        $serviceAgents = ServiceAgent::get()->mapWithKeys(function ($item) {
            return [$item->id => $item->title];
        });
        $title = 'Update Shipment Zone';
        return view('admin/shipmentzone/form', compact('shipmentZone_info', 'title', 'serviceAgents'));
    }

    public function update(Request $request, $id)
    {
        $shipmentZone_info = $this->shipmentZone->find($id);
        if (!$shipmentZone_info) {
            abort(404);
        }
        $this->validate($request, [
            'title' => 'required|string|max:190',
            'publishStatus' => 'required|in:0,1',
            'serviceAgentId' => 'required|exists:service_agents,id'
        ]);
        $data = [
            'title' => $request->title,
            'publishStatus' => $request->publishStatus,
            'updated_by' => Auth::user()->id,
            'serviceAgentId' => $request->serviceAgentId,
            'position' => $request->title,
        ];
        try {
            DB::beginTransaction();
            $shipmentZone_info->fill($data)->save();
            $request->session()->flash('success', 'Shipment Zone updated successfully.');
            DB::commit();
            return redirect()->route('shipmentzone.index');
        } catch (\Exception $error) {
            DB::rollBack();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $shipmentZone_info = $this->shipmentZone->find($id);
        if (!$shipmentZone_info) {
            abort(404);
        }
        try {
            $shipmentZone_info->updated_by = Auth::user()->id;
            $shipmentZone_info->save();
            $shipmentZone_info->delete();
            $request->session()->flash('success', 'Shipment Zone deleted successfully.');
            return redirect()->route('shipmentzone.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
}
