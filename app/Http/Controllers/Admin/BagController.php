<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent\ShipmentPackage;
use App\Models\NationalManifestBag;
use App\Models\NationalManifestPackage;
use App\Models\ShipmentItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bag = NationalManifestBag::select('title', 'id', 'manifestId')
            ->latest()
            ->get();
        return view('admin.nationalManifest.bag.list', compact('bag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bag = new NationalManifestBag();
        return view('admin.nationalManifest.bag.form', compact('bag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $data =  $this->validate($request, [
            'title' => 'required',
            'shipmentItemId' => 'required',
            'shipmentItemId.*' => 'required|exists:shipment_items,id'
        ]);
        DB::beginTransaction();

        try {

            $nationalManifestId =   NationalManifestBag::create(['title' => $data['title'], 'barcode' => $this->makeBarcode()]);
            ShipmentItems::whereIn('id', $data['shipmentItemId'])->update(
                ['isBagged' => 1]
            );
            $nationalManifestId->shipment()->sync($data['shipmentItemId']);
            DB::commit();
            request()->session()->flash('success', "Bag updated successfully");
            return redirect()->route('bag.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bag = NationalManifestBag::with(['shipment' => function ($query) {
            return $query->orderBy('shipmentPackageId', 'DESC');
        }])
            ->with('shipment.shipmentPackage:id,barcode,senderAttention,receiverAttention,totalPiece,total_weight')
            ->findorfail($id);
        return view('admin.nationalManifest.bag.detail', compact('bag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bag = NationalManifestBag::with(['shipment' => function ($query) {
            return $query->orderBy('shipmentPackageId', 'DESC');
        }])
            ->with('shipment.shipmentPackage:id,barcode,senderAttention,receiverAttention,totalPiece,total_weight')
            ->findorfail($id);

        return view('admin.nationalManifest.bag.form', compact('bag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nationalManifestId =   NationalManifestBag::findorfail($id);
        $data =  $this->validate($request, [
            'title' => 'required',
            'shipmentItemId' => 'required',
            'shipmentItemId.*' => 'required|exists:shipment_items,id'
        ]);
        DB::beginTransaction();
        try {

            $nationalManifestId->update(['title' => $data['title']]);
            $nationalManifestId->shipment()->update(['isBagged' => 0]);
            $nationalManifestId->shipment()->sync($data['shipmentItemId']);
            ShipmentItems::whereIn('id', $data['shipmentItemId'])->update(
                ['isBagged' => 1]
            );
            DB::commit();
            request()->session()->flash('success', "Bag created successfully");
            return redirect()->route('bag.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nationalManifestId =   NationalManifestBag::findorfail($id);

        try {
            $nationalManifestId->shipment()->update(['nationalManifest' => 0]);
            $nationalManifestId->delete();

            return redirect()->route('bag.index')->with('success', 'Bag Deleted Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    protected function makeBarcode()
    {
        $random =  'AWB-' . rand(1000000, 9000000);
        if (NationalManifestBag::where('barcode', $random)->first()) {
            $this->makeBarcode();
        }
        return $random;
    }
}
