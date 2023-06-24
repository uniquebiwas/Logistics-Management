<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShipmentPackageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipmentPackageTypeController extends Controller
{
    public function __construct(ShipmentPackageType $shipmentPackageType)
    {
        $this->shipmentPackageType = $shipmentPackageType;
    }

    protected function getshipmentPackageType($request)
    {
        $query = $this->shipmentPackageType;
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('package_type', 'LIKE', '%' . $keyword . '%');
        }
        return $query->orderBy('id', 'DESC')->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->getshipmentPackageType($request);
        return view('admin/shipmentpackagetype/list', compact('data'));
    }

    public function create(Request $request)
    {
        $shipmentPackageType_info = null;
        $title = 'Add New Package Type';
        return view('admin/shipmentpackagetype/form', compact('shipmentPackageType_info', 'title'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'package_type' => 'required|string|min:3|max:190',
            'publishStatus' => 'required|in:1,0'
        ]);
        $data = [
            'package_type' => $request->package_type,
            'image' => $request->image,
            'publishStatus' => $request->publishStatus,
            'created_by' => Auth::user()->id,
        ];
        try {
            $this->shipmentPackageType->fill($data)->save();
            $request->session()->flash('success', 'Shipment Package Type added successfully.');
            return redirect()->route('shipmentpackagetype.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        $shipmentPackageType_info = $this->shipmentPackageType->find($id);
        if (!$shipmentPackageType_info) {
            abort(404);
        }
        $title = 'Update Package Type';
        return view('admin/shipmentpackagetype/form', compact('shipmentPackageType_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $shipmentPackageType_info = $this->shipmentPackageType->find($id);
        if (!$shipmentPackageType_info) {
            abort(404);
        }
        $this->validate($request, [
            'package_type' => 'required|string|min:3|max:190',
            'publishStatus' => 'required|in:1,0'
        ]);
        $data = [
            'package_type' => $request->package_type,
            'publishStatus' => $request->publishStatus,
            'updated_by' => Auth::user()->id,
        ];
        if ($request->image) {
            $data['image'] = $request->image;
        }
        try {
            $shipmentPackageType_info->fill($data)->save();
            $request->session()->flash('success', 'Package Type updated successfully.');
            return redirect()->route('shipmentpackagetype.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $shipmentPackageType_info = $this->shipmentPackageType->find($id);
        if (!$shipmentPackageType_info) {
            abort(404);
        }
        try {
            $shipmentPackageType_info->updated_by = Auth::user()->id;
            $shipmentPackageType_info->save();
            $shipmentPackageType_info->delete();
            $request->session()->flash('success', 'Package Type deleted successfully.');
            return redirect()->route('shipmentpackagetype.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
}
