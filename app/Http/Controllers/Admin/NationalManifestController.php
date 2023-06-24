<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NationalManifestRequest as manifest;
use App\Models\Agent\ShipmentPackage;
use App\Models\NationalManifest;
use App\Models\NationalManifestBag;
use App\Models\NationalManifestPackage;
use Barryvdh\DomPDF\Facade  as PDF;
use Illuminate\Support\Facades\DB;
use NumberFormatter;

class NationalManifestController extends Controller
{
    public function __construct(NationalManifest $nationalManifest)
    {
        $this->nationalManifest = $nationalManifest;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = NationalManifest::withCount('shipment')->latest()->paginate(10);
        $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        return view('admin.nationalManifest.index', compact('data', 'format'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
        $nationalManifest = new NationalManifest();
        return view('admin.nationalManifest.addForm', compact('nationalManifest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'client' => 'required',
            'clientLocation' => 'required',
            'remarks' => 'nullable',
            'phone' => 'nullable',
        ]);
        try {
            $this->nationalManifest->createManifest($data);
            request()->session()->flash('success', 'The national Manifest has been created successfully');
            return redirect()->route('national-manifest.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', 'The national Manifest cannot be created at the moment. Please Try again later');
            return redirect()->back();
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
        $nationalManifest = NationalManifest::with('shipment')->findorfail($id);
        $format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        view()->share(['nationalManifest' => $nationalManifest, 'format' => $format]);
        $pdf = PDF::loadView('admin.nationalManifest.nationalManifest');
        $pdf->setPaper('A3', 'portrait');
        return $pdf->stream($nationalManifest->manifestNumber . ' label.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nationalManifest = NationalManifest::with('shipment')->findorfail($id);
        $selectedShipment = optional($nationalManifest->shipment)->pluck('id');
        return view('admin.nationalManifest.form', compact('nationalManifest', 'selectedShipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(manifest $request, $id)
    {
        $nationalManifest = NationalManifest::findorfail($id);
        $data = $request->validated();

        $sync = collect($data['shipmentId'])->mapWithKeys(function ($item) use ($data) {
            return [$item => ['remarks' => $data['remarks'][$item]]];
        })->toArray();
        DB::beginTransaction();
        try {

            $nationalManifest->shipment()->update(['nationalManifest' => 0]);
            $nationalManifest->shipment()->sync($sync);
            $nationalManifest->update(['total' => $data['total'], 'currencyType' => $data['currencyType']]);
            ShipmentPackage::whereIn('id', $data['shipmentId'])->update(['nationalManifest' => 1]);
            DB::commit();
            request()->session()->flash('success', ' package added success');
            return redirect()->route('national-manifest.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            request()->session()->flash('error', ' package cannot be added at the moment');
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
        $nationalManifest = NationalManifest::findorfail($id);
        DB::beginTransaction();
        try {
            $nationalManifest->shipment()->update(['nationalManifest' => 0]);
            $nationalManifest->delete();
            DB::commit();
            request()->session()->flash('success', 'National Manifest Has been Deleted successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back();
        }
    }
}
