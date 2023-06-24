<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent\ShipmentPackage;
use Barryvdh\DomPDF\Facade  as PDF;
use Illuminate\Http\Request;
use App\Models\Manifest;
use App\Models\ShipmentLocation;
use App\Models\NationalManifestBag;
use Illuminate\Support\Facades\DB;
use NumberFormatter;

class InternationalManifestController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $data = Manifest::latest()
            ->when($request->keyword, function ($query) use ($request) {
                return $query->where('masterAirwayBill', $request->keyword);
            })
            ->withCount('shipment')
            ->paginate(10);
        return view('admin.shipmentpackage.international-list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $data = new Manifest();
        $selectedShipment = collect([]);
        return view('admin.shipmentpackage.international-form', compact('data', 'selectedShipment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $data = $this->validate($request, $this->getRules());
        $data['shipper'] = auth()->id();
        $data['manifest_number'] = Manifest::generateManifestNumber();
        DB::beginTransaction();

        try {
            $manifest =   Manifest::create($data);
            $manifest->shipment()->sync($data['shipmentId']);
            ShipmentPackage::whereIn('id', $data['shipmentId'])->update(['manifest' => 1, 'package_status' => 'MANIFESTED']);
            ShipmentPackage::whereIn('id', $data['shipmentId'])->update(['manifest' => 1, 'package_status' => 'MANIFESTED']);
            for ($i = 0; $i < count($data['shipmentId']); $i++) {
                $locationData[] = [
                    'shipmentId' => $data['shipmentId'][$i],
                    'countryId' => 148,
                    'date' => now(),
                    'location' => 'Kathmandu',
                    'remarks' => 'Automatically update after creating manifest',
                    'package_status' => 'MANIFESTED',
                    'extra_status' => 'SHIPMENT PROCESSING COMPLETED AT ORIGIN',
                    'created_at' => now()
                ];
            }
            // dd($locationData);
            ShipmentLocation::insert($locationData);
            DB::commit();
            request()->session()->flash('success', 'Manifest created successfully');
            return redirect()->route('international-manifest.index');
        } catch (\Throwable $th) {
            DB::rollback();
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
        $manifest = Manifest::findorfail($id);
        $bag = NationalManifestBag::with(['shipment' => function ($query) {
            $query->orderBy('shipmentPackageId', 'DESC');
        }])
            ->with('shipment.shipmentPackage:id,barcode,agentId,senderAttention,receiverAttention,totalPiece,total_weight,content,receiverCompany,receiverAddress,value')
            ->select('title', 'id', 'manifestId')
            ->where('manifestId', $manifest->id)
            ->latest()
            ->get();


        $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);

        view()->share(['manifest' => $manifest, 'bag' => $bag, 'format' => $format]);
        $pdf = PDF::loadView('admin.shipmentpackage.international');
        $pdf->setPaper('A3', 'portrait');

        return $pdf->stream($manifest->manifestNumber . ' label.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $data = Manifest::with('shipment')->findorfail($id);
        $selectedShipment = optional($data->shipment)->pluck('id');
        return view('admin.shipmentpackage.international-form', compact('data', 'selectedShipment'));
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
        $manifest = Manifest::findorfail($id);
        $data = $this->validate($request, $this->getRules());
        $data['shipper'] = auth()->id();
        DB::beginTransaction();
        try {
            $manifest->shipment()->update(['manifest' => 0, 'package_status' => 'RECEIVED']);
            $manifest->update($data);
            $manifest->shipment()->sync($data['shipmentId']);
            ShipmentPackage::whereIn('id', $data['shipmentId'])->update(['manifest' => 1, 'package_status' => 'MANIFESTED']);
            DB::commit();
            request()->session()->flash('success', 'Manifest updated successfully');
            return redirect()->route('international-manifest.index');
        } catch (\Throwable $th) {
            DB::rollback();
            request()->session()->flash('error', 'Manifest cannot be updated at the moment. Please try again later');
            return redirect()->back();
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
        //
    }

    public function nationalManifest($id)
    {
        $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $data = Manifest::findorfail($id);
        return view('admin.shipmentpackage.national', compact('data', 'format'));
    }




    protected function getRules()
    {
        return [
            'client' => 'nullable',
            'clientLocation' => 'nullable',
            'origin' => 'required',
            'flightNumber' => 'required',
            'destination' => 'required',
            'airlines' => 'nullable',
            'date' => 'required',
            'remarks' => 'nullable',
            'masterAirwayBill' => 'required',
            'shipmentId' => 'required',
            'shipmentId.*' => 'required|exists:shipment_packages,id'
        ];
    }
}
