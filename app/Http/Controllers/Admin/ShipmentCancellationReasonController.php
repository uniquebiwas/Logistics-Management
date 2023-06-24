<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShipmentCancellationReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipmentCancellationReasonController extends Controller
{
    public function __construct(ShipmentCancellationReason $cancellationReason)
    {
        $this->cancellationReason = $cancellationReason;
    }

    protected function getcancellationReason($request)
    {
        $query = $this->cancellationReason;
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', '%' . $keyword . '%');
        }
        return $query->orderBy('id', 'DESC')->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->getcancellationReason($request);
        return view('admin/shipmentcancellationreason/list', compact('data'));
    }

    public function create(Request $request)
    {
        $cancellationReason_info = null;
        $title = 'Add New Reason';
        return view('admin/shipmentcancellationreason/form', compact('cancellationReason_info', 'title'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required|string|min:3|max:190',
            'publishStatus' => 'required|in:1,0'
        ]);
        $data = [
            'title' => $request->title,
            'publishStatus' => $request->publishStatus,
            'usage_by' => $request->usage_by,
            'created_by' => Auth::user()->id,
        ];
        try {
            $this->cancellationReason->fill($data)->save();
            $request->session()->flash('success', 'Shipment Cancellation Reason added successfully.');
            return redirect()->route('shipmentcancellationreason.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        $cancellationReason_info = $this->cancellationReason->find($id);
        if (!$cancellationReason_info) {
            abort(404);
        }
        $title = 'Edit Cancellation Reason';
        return view('admin/shipmentcancellationreason/form', compact('cancellationReason_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $cancellationReason_info = $this->cancellationReason->find($id);
        if (!$cancellationReason_info) {
            abort(404);
        }
        $this->validate($request, [
            'title' => 'required|string|min:3|max:190',
            'publishStatus' => 'required|in:1,0'
        ]);
        $data = [
            'title' => $request->title,
            'publishStatus' => $request->publishStatus,
            'usage_by' => $request->usage_by,
            'updated_by' => Auth::user()->id,
        ];
        try {
            $cancellationReason_info->fill($data)->save();
            $request->session()->flash('success', 'Shipment Cancellation Reason updated successfully.');
            return redirect()->route('shipmentcancellationreason.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $cancellationReason_info = $this->cancellationReason->find($id);
        if (!$cancellationReason_info) {
            abort(404);
        }
        try {
            $cancellationReason_info->updatedBy = Auth::user()->id;
            $cancellationReason_info->save();
            $cancellationReason_info->delete();
            $request->session()->flash('success', 'Shipment Cancellation Reason deleted successfully.');
            return redirect()->route('shipmentcancellationreason.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
}
